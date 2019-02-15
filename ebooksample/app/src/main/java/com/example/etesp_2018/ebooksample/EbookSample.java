package com.example.etesp_2018.ebooksample;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

import com.github.barteksc.pdfviewer.PDFView;

public class EbookSample extends AppCompatActivity {
    PDFView pdf;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.sample_ebook);

        pdf = (PDFView)findViewById(R.id.pdfViewer);
        pdf.fromAsset("2018-shift-git-e-github.pdf").load();
    }
}
