package com.example.etesp_2018.login;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        Button btnLogar = (Button) findViewById(R.id.btnLogar);
        Button btnSair = (Button) findViewById(R.id.btnSair);



        btnLogar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                EditText login = (EditText) findViewById(R.id.txtLogin);
                EditText senha = (EditText) findViewById(R.id.txtSenha);

                     String loginCerto = login.getText().toString();
                     String senhaCerta = senha.getText().toString();

                if((loginCerto + "").equals( "oi" )){
                    if(senhaCerta.equals("12")){
                        login.setText("Certo");
                        senha.setText("Certo");

                        OpenAreaRestrita();

                   


                }else {
                    login.setText("Login ou senha errada");
                }
            }



        });



    }
    public void OpenAreaRestrita(){
        Intent intent = new Intent(this,Activity2.class);
        startActivity(intent);

    }
}

