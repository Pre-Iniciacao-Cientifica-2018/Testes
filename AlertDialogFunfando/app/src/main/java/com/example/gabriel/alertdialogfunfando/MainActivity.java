package com.example.gabriel.alertdialogfunfando;

import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        Button btnAlertDialog = (Button) findViewById(R.id.btnAlertDialog);

        btnAlertDialog.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                AlertDialogshow();
                            }
        });

    }
    public void AlertDialogshow(){
        AlertDialog alertDialog;
       alertDialog = new AlertDialog.Builder(this).create();
       alertDialog.setTitle("AlertDialog Funfando");
       alertDialog.setMessage("Aaaaa ta funfando, essa vai pro IC");
       alertDialog.show();
    }




}
