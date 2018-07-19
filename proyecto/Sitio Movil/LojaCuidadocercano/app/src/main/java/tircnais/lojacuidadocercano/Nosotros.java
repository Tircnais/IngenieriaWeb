package tircnais.lojacuidadocercano;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;

import static tircnais.lojacuidadocercano.Constante.proyecto;
import static tircnais.lojacuidadocercano.Constante.servidor;

public class Nosotros extends AppCompatActivity {
    MiURL miURL;
    WebView inicioWeb;
    WebSettings configuracion;
    //miURL.setPagina("about.html");
    String url = servidor+proyecto+"about.html"; //miURL.getIPservidor()+miURL.getProyecto()+miURL.getPagina();
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_nosotros);
        inicioWeb = (WebView) this.findViewById(R.id.wbNosotros);
        //en caso de que pida algun persimo o requiera confirmación
        //configuracion.setJavaScriptEnabled(true);
        //fuera a cargar la URL
        inicioWeb.setWebViewClient(new setURL());
        inicioWeb.loadUrl(url);

    }
    /*
     * Esto para que no se salga de la pagina que se pide que carge
     * */
    private class setURL extends WebViewClient {
        @Override
        public boolean shouldOverrideUrlLoading(WebView view, String url) {
            view.loadUrl(url);
            //return super.shouldOverrideUrlLoading(view, url);
            return true;
        }
    }
}
