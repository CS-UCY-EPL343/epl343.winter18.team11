package com.example.myapplication;

import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.NavigationView;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import java.util.HashMap;

/*For the account activity we will have to first
   1.Get a database connection
   2.View username password ,any orders that happened to that name before

 */

public class AccountActivity extends Navigation
       {
    private SqlManager db;
    TextView name;
    TextView email;
    TextView address;
    Button btnLogout;
    private SessionManager session;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_account);

        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        db = new SqlManager(getApplicationContext());

        setSupportActionBar(toolbar);
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();
        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);
        updateAccountScreen();
        btnLogout = (Button) findViewById(R.id.btnLogout);

        btnLogout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                logoutUser();
            }
        });
    }
    public void updateAccountScreen(){
        /*Get the database connection*/
        db = new SqlManager(getApplicationContext());
        String nameStr;
        String emailStr;
        String addressStr;
        // session manager
        session = new SessionManager(getApplicationContext());

        if (!session.isLoggedIn()) {
           // logoutUser();
        }

        // Fetching user details from sqlite
        HashMap<String, String> user = db.getUserDetails();
       // String name = user.get("name");
      //  String email = user.get("email");
        name = (TextView)findViewById(R.id.usernameAccount);
        email= (TextView) findViewById(R.id.emailAccount);
        address  = (TextView) findViewById(R.id.addressAccount);
        name.setText("Stefanos Ioannou");

    }
           private void logoutUser() {
               session.setLogin(false);
               db.deleteUsers();
               //Launching the login activity
               Intent intent = new Intent(AccountActivity.this, LoginActivity.class);
               startActivity(intent);
               finish();
           }

}
