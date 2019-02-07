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

public class AccountActivity extends Navigation {

    private SqlManager db;
    TextView nameView;
    TextView emailView;
    TextView addressView;
    Button btnLogout;
    private SessionManager session;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_account);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);

        session = new SessionManager(getApplicationContext());
        db = new SqlManager(getApplicationContext());

        updateAccountScreen();
        setSupportActionBar(toolbar);
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();
        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

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
        String nameStr;
        String emailStr;
        String addressStr;
        // session manager

        if (!session.isLoggedIn()) {
            logoutUser();
        }

        // Fetching user details from sqlite
        HashMap<String, String> user = db.getUserDetails();
        String name = user.get("name");
        String email = user.get("email");
        String address = user.get("address");
        String mobile = user.get("mobile");
        nameView = (TextView)findViewById(R.id.usernameAccount);
        emailView = (TextView) findViewById(R.id.emailAccount);
        addressView  = (TextView) findViewById(R.id.addressAccount);
        addressView.setText(address);
        nameView.setText(name);
        emailView.setText(email);
        mobileView.setText(email);

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
