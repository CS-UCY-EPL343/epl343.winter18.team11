package com.example.myapplication;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

public class Send extends AppCompatActivity {

    private static final String SUBJECT = "Emmira Pottery Communication Form";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_send);
        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        Button btnSend = (Button) findViewById(R.id.buttonSend);


        btnSend.setOnClickListener((new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                sendEmail();
            }
        }));
    }
    public void sendEmail(){

        TextView  email = findViewById(R.id.email);
        Intent emailIntent = new Intent(Intent.ACTION_SEND);
        AccountActivity  account = new AccountActivity();

        emailIntent.setData(Uri.parse("mailTo:"));
        emailIntent.setType("text/plain");
        emailIntent.putExtra(Intent.EXTRA_EMAIL,account.getEmail());
        emailIntent.putExtra(Intent.EXTRA_SUBJECT,SUBJECT);
        emailIntent.putExtra(Intent.EXTRA_TEXT,email.getText());

        try{
            startActivity(Intent.createChooser(emailIntent, "Sending Mail"));
            finish();

        }catch (android.content.ActivityNotFoundException ex){

        }

    }

}
