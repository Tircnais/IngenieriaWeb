package tircnais.lojacuidadocercano;

import android.location.Address;
import android.location.Geocoder;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.ActivityCompat;
import android.support.v7.app.AppCompatActivity;
import android.content.Intent;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ScrollView;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.Reader;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;
import java.util.List;
import java.util.Locale;
//GPS
import android.Manifest;
import android.content.Context;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationManager;
import android.support.annotation.NonNull;

//URL
import static tircnais.lojacuidadocercano.Constante.proyecto;
import static tircnais.lojacuidadocercano.Constante.servidor;

public class Adondeir extends AppCompatActivity {
    private TextView LblTitulo, centro, parada;
    private EditText ubicacion, calle;
    private ScrollView indicacionesCentro, indicacionesParada;
    private Button btnActUbicacion, btnBuscar;
    private Spinner titulo;
    ArrayList<String> lista = new ArrayList<>();
    ArrayList<String[]> listcentros = new ArrayList<>();
    ArrayList<String[]> listrutas = new ArrayList<>();
    private String centroSelect, paradaMI="", paradaCentro="", coordenadascentro;
    private double milatitud, milongitud, latitudSelect, longitudSelect;

    static final int REQUEST_LOCATION=1;
    int itemSeleccionado;
    LocationManager locationManager;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_adondeir);
        LblTitulo = (TextView) findViewById(R.id.LblTitulo);
        ubicacion = (EditText) findViewById(R.id.txtUbicacion);
        calle = (EditText) findViewById(R.id.txtCalles);
        indicacionesParada = (ScrollView) findViewById(R.id.scrollParada);
        indicacionesCentro = (ScrollView) findViewById(R.id.scrollCentro);
        centro = (TextView) findViewById(R.id.txtCentro);
        parada = (TextView) findViewById(R.id.txtResultados);
        btnActUbicacion = (Button) findViewById(R.id.btnLocalizar);
        btnBuscar = (Button) findViewById(R.id.btnIr);
        //LblTitulo.setText("¿A donde quiere ir?");

        titulo = (Spinner) findViewById(R.id.spinner);

        centro.setText("Seleccione un centro.");
        parada.setText("Seleccione un centro.");
        String url;
        url = servidor + proyecto + "dll/consultacentros.php"; //miURL.getIPservidor()+miURL.getProyecto()+miURL.getPagina();
        new ConsultarDatos().execute(url);
        url = servidor + proyecto + "dll/consultarutas.php"; //miURL.getIPservidor()+miURL.getProyecto()+miURL.getPagina();
        new ConsultarCentros().execute(url);
        titulo.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int pos, long id) {
                String[] ir = listcentros.get(pos);
                //(String) adapterView.getItemAtPosition(pos)
                Toast.makeText(adapterView.getContext(), ir[0]+"\nCoordenadas: "+ir[1]+", "+ir[2], Toast.LENGTH_SHORT).show();
                limpiar();
                itemSeleccionado = pos;
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {
            }
        });


        locationManager =(LocationManager)getSystemService(Context.LOCATION_SERVICE);
        getLocation();
        //Implementamos el evento click del botón
        btnActUbicacion.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                limpiar();
                getLocation();
                Toast.makeText(getApplicationContext(),"Recalculando",Toast.LENGTH_LONG).show();
            }
        });
        btnBuscar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Toast.makeText(getApplicationContext(), "Espere...", Toast.LENGTH_LONG).show();
                String[] estecentro = listcentros.get(itemSeleccionado);
                centroSelect = estecentro[0];
                latitudSelect = Double.parseDouble(estecentro[1]);
                longitudSelect = Double.parseDouble(estecentro[2]);
                System.out.println("A donde voy? "+latitudSelect+", "+ longitudSelect);
                //parada mas cercana al centro, y parada mas cercana a mi
                double distcentro, distmi;
                distmi = paradacercana(listrutas, milatitud, milongitud, 2);
                distcentro = paradacercana(listrutas, latitudSelect, longitudSelect, 1);
                String guia = "", instruccion = "";
                instruccion += "Ruta: "+paradaMI;
                instruccion += "\nDistancia a la parada:\t"+distmi;
                guia += "Ruta: "+paradaCentro;
                guia += "\nDistancia al centro:\t"+distcentro;
                guia += coordenadascentro;
                centro.setText(guia);
                parada.setText(instruccion);
            }
        });
    }

    private void getLocation() {
        String direc="";
        if(ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION)
                != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION)
                != PackageManager.PERMISSION_GRANTED) {
            ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.ACCESS_FINE_LOCATION}, REQUEST_LOCATION);

        } else {
            Location location = locationManager.getLastKnownLocation(LocationManager.NETWORK_PROVIDER);
            if (location != null){
                double latti = location.getLatitude();
                double longi = location.getLongitude();
                milatitud = latti;
                milongitud = longi;
                ubicacion.setText(latti+", "+longi);
                direc= setStreetLocation(milatitud, milongitud);
                String[] callecompleta = direc.split(",");
                direc = callecompleta[0];
                calle.setText(direc);
            } else {
                ubicacion.setText("No disponible");
            }
        }

    }
    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions,@NonNull int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
        switch (requestCode) {
            case REQUEST_LOCATION:
                getLocation();
                break;
        }
    }


    /**
     * Calle localizada en esas coordenadas (Puede enviarse Location)
     * @param lonEncontrada latitud
     * @param latEncontrada longitud
     * @return String CALLE encontrada con las coordenadas
     */
    private String setStreetLocation(double latEncontrada, double lonEncontrada) {
        //System.out.println("OBTIENE CALLLE.");
        //Obtener la direcci—n de la calle a partir de la latitud y la longitud
        Geocoder geocoder = new Geocoder(this, Locale.getDefault());
        String calle="";
        try {
            List<Address> list = geocoder.getFromLocation(latEncontrada, lonEncontrada, 4);
            //System.out.println("Direccion: "+list);
            if (!list.isEmpty()) {
                Address address = list.get(0);
                calle=address.getAddressLine(0);
                System.out.println("Distancia desde aki:"+latEncontrada+", "+ lonEncontrada+"\t\tCALLE encontrada: "+calle);
            }else{
                calle="No encontrada";
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
        return calle;
    }
    private void limpiar() {
        ubicacion.setText("Desconocida");
        calle.setText("No encontrada");
        centro.setText("Seleccione un centro");
        parada.setText("Seleccione un centro");
        //Toast.makeText(getApplicationContext(), "Limpieza de contenido", Toast.LENGTH_LONG).show();
    }


    private String downloadUrl(String myurl) throws IOException {
        Log.i("URL", "" + myurl);
        myurl = myurl.replace(" ", "%20");
        InputStream is = null;
        int len = 500;
        try {
            URL url = new URL(myurl);
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setReadTimeout(10000 /* milliseconds */);
            conn.setConnectTimeout(15000 /* milliseconds */);
            conn.setRequestMethod("GET");
            conn.setDoInput(true);
            // Inicia la consulta
            conn.connect();
            int response = conn.getResponseCode();
            //Log.d("Respuesta", "La respuesta es: " + response);
            is = conn.getInputStream();
            // Convert the InputStream into a string
            String contentAsString = readIt(is, len);
            //System.out.println("LA salida de la URL?? "+ contentAsString);
            return contentAsString;
            // Asegura que el InputStream se cierre después de que la aplicación esté terminado de usarlo.
        } finally {
            if (is != null) {
                is.close();
            }
        }
    }

    public class ConsultarDatos extends AsyncTask<String, Void, String> {
        @Override
        protected String doInBackground(String... urls) {
            // params comes from the execute() call: params[0] is the url.
            try {
                return downloadUrl(urls[0]);
            } catch (IOException e) {
                return "No se puede recuperar la página web. La URL puede no ser válida.";
            }
        }

        // onPostExecute displays the results of the AsyncTask.
        @Override
        protected void onPostExecute(String result) {
            String[] centros = null;
            JSONArray jsonArray = null;
            try {
                jsonArray = new JSONArray(result);
                String cod, nomb, latitud, longitud;
                int tamaño = jsonArray.length();
                for (int i = 0; i < tamaño; i++) {
                    JSONArray item = jsonArray.getJSONArray(i);
                    int a= item.length();
                    //System.out.println("Tam. Elmento: "+a);
                    centros = new String[a];
                    //nomb = item.getString("nombre");
                    //nomb = jsonArray.get(i).toString();
                    item = jsonArray.getJSONArray(i);
                    nomb = item.get(0).toString();
                    latitud = String.valueOf(item.getDouble(1));
                    longitud = String.valueOf(item.getDouble(2));
                    centros[0]= nomb;
                    centros[1]= latitud;
                    centros[2]= longitud;
                    //latitudSelect= Double.parseDouble(item.getString("Latitud"));
                    //longitudSelect= Double.parseDouble(item.getString("Longitud"));
                    //longitudSelect= item.getDouble(2);
                    //System.out.println("ARRAY: "+item.toString());
                    lista.add(nomb);
                    listcentros.add(centros);
                    //System.out.println("LISTA: " + nomb);
                    //Toast.makeText(getApplicationContext(),"Consulta de centros",Toast.LENGTH_LONG).show();
                }
                titulo.setAdapter(new ArrayAdapter<String>(Adondeir.this, android.R.layout.simple_spinner_item, lista));
            } catch (JSONException e) {
                e.printStackTrace();
                System.out.println("Excepcion JSON_centros: "+e.getMessage());
            }
        }
    }

    public class ConsultarCentros extends AsyncTask<String, Void, String> {
        @Override
        protected String doInBackground(String... urls) {
            // params comes from the execute() call: params[0] is the url.
            try {
                return downloadUrl(urls[0]);
            } catch (IOException e) {
                return "No se puede recuperar la página web. La URL puede no ser válida.";
            }
        }

        // onPostExecute displays the results of the AsyncTask.
        @Override
        protected void onPostExecute(String result) {
            String[] centros = null;
            JSONArray jsonArray = null;
            try {
                jsonArray = new JSONArray(result);
                String codigo, tituloRuta, linea, intervalo;
                double latitud, longitud;
                int tamaño = jsonArray.length();
                for (int i = 0; i < tamaño; i++) {
                    JSONArray item = jsonArray.getJSONArray(i);
                    int a= item.length();
                    centros = new String[a];
                    item = jsonArray.getJSONArray(i);
                    codigo = item.get(0).toString();
                    tituloRuta = item.get(1).toString();
                    linea = item.get(2).toString();
                    intervalo = item.get(3).toString();
                    latitud = item.getDouble(4);
                    longitud = item.getDouble(5);
                    centros[0]= codigo;
                    centros[1]= tituloRuta;
                    centros[2]= linea;
                    centros[3]= intervalo;
                    centros[4]= String.valueOf(latitud);
                    centros[5]= String.valueOf(longitud);
                    listrutas.add(centros);
                }
            } catch (JSONException e) {
                e.printStackTrace();
                System.out.println("Excepcion JSON_rutas: "+e.getMessage());
            }
        }
    }

    public String readIt(InputStream stream, int len) throws IOException, UnsupportedEncodingException {
        Reader reader;
        reader = new InputStreamReader(stream, "UTF-8");
        char[] buffer = new char[len];
        reader.read(buffer);
        return new String(buffer);
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        String url = servidor + proyecto + "dll/consulta.php";
        new ConsultarDatos().execute(url);
    }


    /*
    PendingResult<PlaceLikelihoodBuffer> result = Places.PlaceDetectionApi.getCurrentPlace(apiClient, null);
        result.setResultCallback( new ResultCallback<PlaceLikelihoodBuffer>() {
            @Override
            public void onResult( PlaceLikelihoodBuffer likelyPlaces ) {
                for (PlaceLikelihood placeLikelihood : likelyPlaces) {
                    System.out.println(String.format("Place '%s' has likelihood: %g",
                            placeLikelihood.getPlace().getName(),
                            placeLikelihood.getLikelihood()));
                    lugar1.setText(likelyPlaces.get(0).getPlace().getName());
                    lugar2.setText(likelyPlaces.get(1).getPlace().getName());
                    lugar3.setText(likelyPlaces.get(2).getPlace().getName());
                    lugar4.setText(likelyPlaces.get(3).getPlace().getName());
                }
                likelyPlaces.release();
            }
        });
    */

    /**
     * Parada mas cercana
     * @param listrutas Lista de rutas y las coordenas de sus paradas
     * @param latitudSelect del centro
     * @param longitudSelect del centro
     * @param tipo Indica 1 si es cercana al centro, 2 si es cercana a mi
     * @return double Distancia mas cercana
     */
    //Mi marcador y las RUTAs (coordenadas de paradas)
    public Double paradacercana(ArrayList<String[]> listrutas, double latitudSelect, double longitudSelect, int tipo) {
        float[] result = new float[1];
        ArrayList<String[]> paradas = new ArrayList<>();
        ArrayList<Double> distancias = new ArrayList<>();
        String calle;
        double paradalat=0, paradalon=0, centrolatitud=0, centrolongitud=0, distancia;
        centrolatitud = latitudSelect;
        centrolongitud = longitudSelect;
        if(tipo ==1 ){
            System.out.println("TIPO.. Coordenadas del centro"+ centrolatitud+ ", "+centrolongitud);
        }else{
            System.out.println("TIPO.. Mi ubicación"+ centrolatitud+ ", "+centrolongitud);
        }
        for (String[] ruta: listrutas) {
            String[] parada = ruta;
            paradalat = Double.parseDouble(parada[4]);
            paradalon = Double.parseDouble(parada[5]);
            if (tipo == 1){
                System.out.println("Distancia al CENTRO desde aki:"+centrolatitud+", "+ centrolongitud+"\t\tHacia: "+paradalat+", "+ paradalon);
                Location.distanceBetween(centrolatitud, centrolongitud, paradalat, paradalon, result);
            }else{
                System.out.println("Distancia a MI desde aki:"+paradalat+", "+ paradalon+"\t\tHacia: "+centrolatitud+", "+ centrolongitud);
                Location.distanceBetween(paradalat, paradalon, centrolatitud, centrolongitud, result);
            }
            distancia = (double) result[0];
            //Redondear a 2 decimales
            distancia = Math.round(distancia * 100.0) / 100.0;
            String[] coordenadas= new String[ruta.length+1];
            coordenadas[0]= parada[0];
            coordenadas[1]= parada[1];
            coordenadas[2]= parada[2];
            coordenadas[3]= parada[3];
            coordenadas[4]= parada[4];
            coordenadas[5]= parada[5];
            coordenadas[6]= String.valueOf(distancia);
            distancias.add(distancia);
            paradas.add(coordenadas);
        }
        double min;
        min = distancias.get(0);
        for (int i = 0; i < distancias.size(); i++) {
            if(distancias.get(i)<min){
                min=distancias.get(i);
            }
        }
        for (int i = 0; i < distancias.size(); i++) {
            String[] parada = paradas.get(i);
            if (Double.parseDouble(parada[6])==min){
                String ruta = parada[1];
                String linea = parada[2];
                //String coordenadaparada = parada[4]+", "+parada[5];
                paradalat = Double.parseDouble(parada[4]);
                paradalon = Double.parseDouble(parada[5]);
                String coordenadaparada = paradalat+", "+ paradalon;
                calle = setStreetLocation(paradalat, paradalon);//calles de la parada
                //calle = setStreetLocation(centrolatitud, centrolongitud);//calles del centro
                String[] callecompleta = calle.split(",");
                calle = callecompleta[0];
                coordenadascentro = "\nCoordenadas del centro: "+centrolatitud +", "+ centrolongitud;
                if (tipo == 1){
                    paradaCentro = ruta+"\tLinea: "+linea+"\nParada mas cercana.\n"+calle+" ("+coordenadaparada+")???";
                }else {
                    paradaMI = ruta+"\tLinea: "+linea+"\nParada mas cercana.\n"+calle+" ("+coordenadaparada+")...";
                    //AKI
                }
            }
        }
        System.out.println("Desde aki distancia:\t"+min+coordenadascentro);
        System.out.println("Distancia menor:\t"+min);
        return min;
        //return (double) result[0];
    }
    
}
