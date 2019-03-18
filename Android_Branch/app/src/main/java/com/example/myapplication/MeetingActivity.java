package com.example.myapplication;

import android.app.ProgressDialog;
import android.icu.text.SimpleDateFormat;
import android.os.Build;
import android.os.Bundle;
import android.os.Handler;
import android.support.design.widget.NavigationView;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.widget.Toolbar;
import android.text.Editable;
import android.text.TextWatcher;
import android.util.Log;
import android.view.KeyEvent;
import android.view.View;
import android.widget.Button;
import android.widget.CalendarView;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.Date;
import java.util.HashMap;
import java.util.Map;

public class MeetingActivity extends Navigation {

    private SqlManager db;
    private CalendarView calendar;
    private EditText timeCal;
    private Button MeetingButton ;
    private ProgressDialog pDialog;
    private  String email = null;/*DateFormat pick the dates*/
    private  String time = null;
    private  String date = null;
    private Boolean valid = false;
    public abstract class TextValidator implements TextWatcher {
        private final TextView textView;

        public TextValidator(TextView textView) {
            this.textView = textView;
        }

        public abstract void validate(TextView textView, String text);

        @Override
        final public void afterTextChanged(Editable s) {
            String text = textView.getText().toString();
            validate(textView, text);
        }

        @Override
        final public void beforeTextChanged(CharSequence s, int start, int count, int after) { /* Don't care */ }

        @Override
        final public void onTextChanged(CharSequence s, int start, int before, int count) { /* Don't care */ }
    }
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_meeting);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        toolbar.setTitle(getResources().getString(R.string.time_name));
        setSupportActionBar(toolbar);
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();
        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);
        // Progress dialog
        pDialog = new ProgressDialog(this);
        pDialog.setCancelable(false);

        calendar = (CalendarView) findViewById(R.id.calendarView);
        timeCal = (EditText) findViewById(R.id.dayTime);
        MeetingButton = (Button) findViewById(R.id.MeetingButton);
        timeCal.setImeActionLabel("Custom text", KeyEvent.KEYCODE_ENTER);

        timeCal.setOnKeyListener(new View.OnKeyListener() {
            @Override
            public boolean onKey(View v, int keyCode,
                                          KeyEvent event)
            {
                boolean handled = false;
                Log.wtf("TAG", String.valueOf(event.getAction()+"Spacebar is "+ KeyEvent.KEYCODE_ENTER));
                if ( event.getKeyCode() == KeyEvent.KEYCODE_ENTER)
                {
                    Log.wtf("TAG","entered");
                    Log.wtf("timecal",timeCal.getText().toString());

                    if (timeCal.getText().toString().matches("[^a-zA-Z]")){
                        pDialog.setMessage("Valid Phone number");
                        showDialog();
                        valid = true;
                    }
                    else {
                        pDialog.setMessage("Not a valid phone number");
                        showDialog();
                        valid = false;
                    }
                    handled = true;

                    Handler handler = new Handler();
                    handler.postDelayed(new Runnable() {
                        public void run() {
                            pDialog.dismiss();
                        }
                    }, 2000);
                }
                return handled;
            }
        });
        MeetingButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                db = new SqlManager(getApplicationContext());
                HashMap<String, String> user = db.getUserDetails();
                email = user.get("email");
                if (valid == true ) {
                    getDates();
                    sendDates(date, time, email);
                }
                valid = false;
            }
        });
    }
        public void getDates() {

            SimpleDateFormat sdf = null;
            time = timeCal.getText().toString();
            if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.N) {
                sdf = new SimpleDateFormat("dd/MM/yyyy");
            }
            if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.N) {
                date = sdf.format(new Date(calendar.getDate()));
            }
        }
            private void sendDates(final String date, final String time , final String email) {
                    String tag_string_req = "req_update";
                    pDialog.setCancelable(false);
                    pDialog.setMessage("Sending the meeting!");

                    Handler handler = new Handler();
                    handler.postDelayed(new Runnable() {
                        public void run() {
                            pDialog.dismiss();
                        }
                    }, 2000);

                    StringRequest strReq = new StringRequest(Request.Method.POST,
                            NetworkConfigure.URL_MEETING, new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            hideDialog();
                            try {
                                JSONObject jObj = new JSONObject(response);
                                boolean error = jObj.getBoolean("error");
                                if (!error) {
                                    pDialog.setMessage("Your meeting is stored ! ");

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

                        @Override
                        protected Map<String, String> getParams() {
                            // Posting parameters to login url
                            Map<String, String> params = new HashMap<String, String>();
                            params.put("email", email);
                            params.put("time", time);
                            params.put("date", date);

                            return params;
                        }
                    };
                    // Adding request to request queue
                    StartController.getmInstance().addToRequestQueue(strReq, tag_string_req);

            }
    private void showDialog() {
        if (!pDialog.isShowing())
            pDialog.show();
    }

    private void hideDialog() {
        if (pDialog.isShowing())
            pDialog.dismiss();
    }
}
