package com.example.myapplication;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.support.design.widget.NavigationView;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import java.util.HashMap;
/**
 * Class for sending email activity. It opens an xml file where the user can send an email.
 */
public class SendActivity extends Navigation {


    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_send1);
        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        Button btnSend = (Button) findViewById(R.id.buttonSend);

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();
        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

        EditText email = findViewById(R.id.email);
        email.setSelection(0);
        btnSend.setOnClickListener((new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                sendEmail();
            }
        }));
    }

    /**
     * This function is used in order to sent an email
     * It parses the text from the email editext and the subject editext
     */
    public void sendEmail(){
        SqlManager db = new SqlManager(getApplicationContext());

        EditText email = findViewById(R.id.email);
        email.setSelection(0);
        EditText  subjectID = (EditText)findViewById(R.id.subjectID);
        Intent emailIntent = new Intent(Intent.ACTION_SEND);
        HashMap<String, String> user = db.getUserDetails();
        String emailStr = user.get("email");
        emailIntent.setData(Uri.parse("mailTo:"));
        emailIntent.setType("text/plain");
        emailIntent.putExtra(Intent.EXTRA_EMAIL,new String[] { "emmirapottery@gmail.com" }); //For testing purposes
        emailIntent.putExtra(Intent.EXTRA_SUBJECT,subjectID.getText());
        emailIntent.putExtra(Intent.EXTRA_TEXT,email.getText());
        try{
            startActivity(Intent.createChooser(emailIntent, "Sending Mail"));
        }catch (android.content.ActivityNotFoundException ex){ }
    }
    @Override
    public void onBackPressed() {
       //Do nothing
    }

}
