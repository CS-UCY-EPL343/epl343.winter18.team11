package com.example.myapplication;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.NavigationView;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.widget.Toolbar;
import android.text.InputType;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;




/**
 *  Class responsible for Account View activity,where the user can
 *  see his/her email , name ,mobile phone and address.
 */
public class AccountActivity extends Navigation {

    private SqlManager db;
    TextView nameView;
    TextView emailView;
    TextView addressView;
    TextView mobileView;
    TextView titleView;

    EditText nameViewChange;
    EditText addressViewChange;
    EditText mobileViewChange;
    EditText emailViewChange;

    Button btnLogout;
    Button btnUpdate;
    Button btnSend;
    private SessionManager session;
    private ProgressDialog pDialog;

    String name;
    String email;
    String mobile;
    String address;
    String email_cur;
    String name_cur;

    /**
     *This method updates data of the user. It hits the Url update which is the endpoint to change the
     * data in phpmyadmin
     * @param mobile New mobile of customer
     * @param address New address of customer
     * @param name New name of customer
     * @param email New email of customer
     * @param cur_name Current name of customer
     * @param cur_email Current email of customer
     *
     */
    protected void update(final String mobile, final String address, final String name, final String email, final String cur_name, final String cur_email) {
        String tag_string_req = "req_update";
        pDialog = new ProgressDialog(this);
        pDialog.setCancelable(false);
        pDialog.setMessage("Updating");

        StringRequest strReq = new StringRequest(Request.Method.POST,
                NetworkConfigure.URL_UPDATE, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                hideDialog();
                try {
                    JSONObject jObj = new JSONObject(response);
                    boolean error = jObj.getBoolean("error");
                    if (!error) {
                        pDialog.setMessage("You are about to log out form the System so update takes place!");
                        logoutUser();
                    } else {
                        // Error in login. Get the error message
                        String errorMsg = jObj.getString("error_msg");
                        Toast.makeText(getApplicationContext(),
                                errorMsg, Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    // JSON error
                    e.printStackTrace();
                    Toast.makeText(getApplicationContext(), "Json error: " + e.getMessage(), Toast.LENGTH_LONG).show();
                }

            }
        }, new Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(),
                        error.getMessage(), Toast.LENGTH_LONG).show();
                hideDialog();
            }
        }) {
         /**
             *  Posting parameters to login url
             *
             */
            @Override
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<String, String>();
                params.put("email", email);
                params.put("address", address);
                params.put("mobile", mobile);
                params.put("name", name);
                params.put("cur_name", cur_name);
                params.put("cur_email", cur_email);

                return params;
            }
        };
        // Adding request to request queue
        StartController.getmInstance().addToRequestQueue(strReq, tag_string_req);
    }
    /**
     * Create the account activity instance
     */
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
        btnUpdate = (Button) findViewById(R.id.btnSendOrder);
        btnSend = (Button) findViewById(R.id.btnSend);


        btnUpdate.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                /*Get the local Strings from the phone */
                name = nameView.getText().toString();
                email = emailView.getText().toString();
                address = addressView.getText().toString();
                mobile = mobileView.getText().toString();
                name_cur = nameView.getText().toString();
                email_cur = emailView.getText().toString();

                nameView.setText("");
                emailView.setText("");
                mobileView.setText("");
                addressView.setText("");

                emailView.  setInputType(InputType.TYPE_TEXT_VARIATION_EMAIL_ADDRESS);
                nameView.setInputType(InputType.TYPE_CLASS_TEXT | InputType.TYPE_TEXT_VARIATION_NORMAL);
                mobileView.setInputType(InputType.TYPE_NUMBER_VARIATION_NORMAL);
                addressView.setInputType(InputType.TYPE_CLASS_TEXT);

                btnUpdate.setVisibility(View.GONE);
                btnSend.setVisibility(View.VISIBLE);
                nameView.setVisibility(View.GONE);

                nameViewChange.setVisibility(View.VISIBLE);
                nameViewChange.setText(name);

                emailViewChange.setVisibility(View.VISIBLE);
                emailViewChange.setText(email);

                mobileViewChange.setVisibility(View.VISIBLE);
                mobileViewChange.setText(mobile);

                addressViewChange.setVisibility(View.VISIBLE);
                addressViewChange.setText(address);

            }
        });


        btnSend.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                name = nameViewChange.getText().toString();
                address = addressViewChange.getText().toString();
                email = emailViewChange.getText().toString();
                mobile = mobileViewChange.getText().toString();

                update(mobile, address, name, email, name_cur, email_cur);
                logoutUser();
            }
        });

        btnLogout.setOnClickListener(new View.OnClickListener(){
        @Override
        public void onClick (View v){
            logoutUser();
         }
        });
    }

    /**
     * Update the Account Screen with the name, email, address and mobile of the user
     */
    public void updateAccountScreen(){

        if (!session.isLoggedIn()) {
            logoutUser();
        }

        // Fetching user details from sqlite
        HashMap<String, String> user = db.getUserDetails();

        String name = user.get("name");
        String email = user.get("email");
        String address = user.get("address");
        String mobile = user.get("mobile");

        /*Normal Views*/
        nameView = (TextView)findViewById(R.id.usernameAccount);
        emailView = (TextView) findViewById(R.id.emailAccount);
        addressView  = (TextView) findViewById(R.id.addressAccount);
        mobileView = (TextView)findViewById(R.id.mobileAccount);
        /*Changed Views*/
        nameViewChange = (EditText)findViewById(R.id.usernameAccountChange);
        addressViewChange = (EditText)findViewById(R.id.addressAccountChange);
        mobileViewChange = (EditText)findViewById(R.id.mobileAccountChange);
        emailViewChange = (EditText)findViewById(R.id.emailAccountChange);

        addressView.setText(address);
        nameView.setText(name);
        emailView.setText(email);
        mobileView.setText(mobile);

    }
           private void logoutUser() {
               session.setLogin(false);
               db.deleteTables();
               //Launching the login activity
               Intent intent = new Intent(AccountActivity.this, LoginActivity.class);
               startActivity(intent);
               finish();
           }

           /**
            * Show the android dialog to the user
            */
    private void showDialog() {
        if (!pDialog.isShowing())
            pDialog.show();
    }
    /**
     * Hide the android dialog to the user
     */
    private void hideDialog() {
        if (pDialog.isShowing())
            pDialog.dismiss();
    }
    /**
     * When the user press the back buttton , start the
     * account activity
     */
    @Override
    public void onBackPressed() {
       //DO nothing
    }
}
