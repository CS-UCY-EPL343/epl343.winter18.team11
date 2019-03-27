package com.example.myapplication;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import java.util.HashMap;

public class SendActivity extends Navigation {

    /*On back pressed */
    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }
    @Override
    /**
     * On create of the send activity. It opens an xml file where the user can send an email.
     */
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

        TextView  email = findViewById(R.id.email);
        TextView  subject = findViewById(R.id.subject);
        Intent emailIntent = new Intent(Intent.ACTION_SEND);
        HashMap<String, String> user = db.getUserDetails();
        String emailStr = user.get("email");
        emailIntent.setData(Uri.parse("mailTo:"));
        emailIntent.setType("text/plain");
        emailIntent.putExtra(Intent.EXTRA_EMAIL,"bluemindset@outlook.com");
        emailIntent.putExtra(Intent.EXTRA_SUBJECT,subject.getText());
        emailIntent.putExtra(Intent.EXTRA_TEXT,email.getText());
        try{
            startActivity(Intent.createChooser(emailIntent, "Sending Mail"));


        }catch (android.content.ActivityNotFoundException ex){ }
    }
}
