package com.example.gabriel.prjic;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);


        Button btnLivroDigital = findViewById(R.id.btnLivroDigital);
        Button btnConcReal = findViewById(R.id.btnConcReal);
        btnConcReal.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                AbrirPag(3);
            }
        });
        btnLivroDigital.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                AbrirPag(1);
            }
        });

    }

    public void AbrirPag(int i ){
        Intent intent;
        if(i == 1){
            intent = new Intent(getApplicationContext(),SecondActivity.class);


        }else{
            intent = new Intent(getApplicationContext(),SecondActivity.class);


        }
        startActivity(intent);

    }
}
