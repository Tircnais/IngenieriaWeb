package tircnais.lojacuidadocercano;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.Button;
import android.widget.ViewFlipper;

public class Principal extends AppCompatActivity {

    Button Gestion, Visual, Ira, nosotros, Inicio, Contactos, Login;
    Animation fade_in, fade_out;
    ViewFlipper viewFlipper;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_principal);

        viewFlipper = (ViewFlipper) this.findViewById(R.id.ViewFlipper1);
        fade_in  = AnimationUtils.loadAnimation(this, android.R.anim.fade_in);
        fade_out  = AnimationUtils.loadAnimation(this, android.R.anim.fade_out);

        viewFlipper.setInAnimation(fade_in);
        viewFlipper.setOutAnimation(fade_out);

        //set auto flipping
        viewFlipper.setAutoStart(true);
        viewFlipper.setFlipInterval(2000);
        viewFlipper.startFlipping();

        Inicio = (Button) findViewById(R.id.btnInicio);
        Gestion = (Button) findViewById(R.id.btnGestion);
        Ira = (Button) findViewById(R.id.btnIR);

        Visual = (Button) findViewById(R.id.btnVisual);
        nosotros = (Button) findViewById(R.id.btnNosotros);
        Contactos = (Button) findViewById(R.id.btnContactos);
        
        Login = (Button) findViewById(R.id.btnLogin);

        Inicio.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick (View v){
                AbrirInicio();
            }
        });

        Gestion.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick (View v){
                AbrirGestion();
            }
        });

        Ira.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick (View v){
                ejecutar_Ira();
            }
        });

        Visual.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick (View v){
                ejecutar_Visual();
            }
        });

        nosotros.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick (View v){
                ejecutar_nosotros();
            }
        });

        Contactos.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick (View v){
                AbrirContactos();
            }
        });

        Login.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick (View v){
                AbrirLogin();
            }
        });
    }

    public void AbrirInicio(){
        Intent ventanaInicio = new Intent(this,Inicio.class);
        startActivity(ventanaInicio);
    }

    public void AbrirGestion(){
        Intent ventanaGestion = new Intent(this,Administracion.class);
        startActivity(ventanaGestion);
    }

    public void ejecutar_Ira(){
        Intent ventanaIR = new Intent(this,Adondeir.class);
        startActivity(ventanaIR);
    }

    public void ejecutar_Visual(){
        Intent ventanaVisual = new Intent(this,Visualizacion.class);
        startActivity(ventanaVisual);
    }

    public void ejecutar_nosotros(){
        Intent ventanaNosotros = new Intent(this,Nosotros.class);
        startActivity(ventanaNosotros);
    }

    public void AbrirContactos(){
        Intent ventanaContacto = new Intent(this,Contactos.class);
        startActivity(ventanaContacto);
    }

    public void AbrirLogin(){
        Intent ventanaLogin = new Intent(this,Login.class);
        startActivity(ventanaLogin);
    }

}
