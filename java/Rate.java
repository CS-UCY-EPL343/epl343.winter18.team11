package c.tests.Team11;

import android.os.AsyncTask;
import android.os.Bundle;

import java.sql.PreparedStatement;

import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v4.widget.DrawerLayout;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;

import android.widget.RatingBar;
import android.widget.Toast;

import java.sql.Connection;

import android.widget.ViewAnimator;

import java.util.Timer;
import java.util.TimerTask;

import static java.lang.Math.abs;

/** This class gives the chance to the user to rate the shop
 * the rating will also be added to the database.
 */


public class Rate extends Fragment {

    RatingBar rbar;
    Account account= Account.getUniqueInstance();
    Float ratingvalue;
    static ViewAnimator anime;
    Timer myTimer;


    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {

        View v = inflater.inflate(c.tests.Team11.R.layout.rate, container, false);

        return v;
    }

    /**
     * In this method we set the actions that
     * must be made in case the user press
     * any of the buttons or text box of the page.
     * @param view
     * @param savedInstanceState
     */
    public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);
        getActivity().setTitle("Rate");





        DrawerLayout mDrawerLayout = (DrawerLayout)getActivity(). findViewById(c.tests.Team11.R.id.drawer_layout);
        mDrawerLayout.addDrawerListener(new DrawerLayout.DrawerListener() {

            @Override
            public void onDrawerSlide(View drawerView, float slideOffset) {

                //Called when a drawer's position changes.
            }

            @Override
            public void onDrawerOpened(View drawerView) {myTimer.cancel();
                //Called when a drawer has settled in a completely open state.
                //The drawer is interactive at this point.
                // If you have 2 drawers (left and right) you can distinguish
                // them by using id of the drawerView. int id = drawerView.getId();
                // id will be your layout's id: for example R.id.left_drawer
            }

            @Override
            public void onDrawerClosed(View drawerView) {
                // Called when a drawer has settled in a completely closed state.
            }

            @Override
            public void onDrawerStateChanged(int newState) {

            }
        });

        anime = (ViewAnimator)getActivity().findViewById(c.tests.Team11.R.id.anime);
        final Animation inAnim = AnimationUtils.loadAnimation(getActivity(),android.R.anim.slide_in_left);
        final Animation outAnim = AnimationUtils.loadAnimation(getActivity(),android.R.anim.slide_out_right);

         myTimer = new Timer();
        myTimer.schedule(new TimerTask() {
            @Override
            public void run() {
                getActivity().runOnUiThread(Timer_Tick);

            }

        }, 2, 1000);





        final String check= account.getIscustomer();
                rbar = (RatingBar) getActivity().findViewById(c.tests.Team11.R.id.ratingBar);
        rbar.setOnRatingBarChangeListener(new RatingBar.OnRatingBarChangeListener() {
            @Override
            public void onRatingChanged(RatingBar ratingBar, float rating, boolean fromUser) {
                if (check.equals("2")) {


                    Toast.makeText(getContext(), "You have to be logged in to rate.", Toast.LENGTH_SHORT).show();
                } else {

                     ratingvalue = (Float) rbar.getRating();
                    //Toast.makeText(getContext(), " Ratings1 : " + ratingvalue + "", Toast.LENGTH_SHORT).show();

                    SaveRate srate= new SaveRate();
                    srate.execute();
                }
            }
        });
    }





    private Runnable Timer_Tick = new Runnable() {
        public void run() {
            anime.showNext();
            //This method runs in the same thread as the UI.

            //Do something to the UI thread here


        }
    };



    private class SaveRate extends AsyncTask<String, String, String> {

        String message = "Thank you for the rate!";        // The message for the Toast


        /**
         * This method is happening on the background, it checks the saved credentials if they are
         * matching with the existing records on the database.
         * @param params
         * @return null
         */
        protected String doInBackground(String... params) {

            try {
                // Create the connection with database
                ConnectDB connection = new ConnectDB();
                Connection conn = connection.establishConnection();

                // If the connection failed
                if (conn == null) {
                    message = "Please check your connection!";
                    return message;
                }



                    String sql = "UPDATE `User` SET `Rating`=?  WHERE `Email` = '"+account.getEmail()+"'";

                        PreparedStatement statement = null;

                        try {
                            // Create and execute statement
                            statement = conn.prepareStatement(sql);


                            statement.setFloat(1,ratingvalue);

                            statement.executeUpdate();
                        } catch (Exception ex) {
                            message = "Your rate hasn't been save.Try again!";
                        }



            } catch (Exception ex) {
                message = ex.getMessage();
            }

            return message;
        }


        @Override
        protected void onPostExecute(String z) {
            // wright the informing message whether everything was successful or not.
            Toast.makeText(getActivity(), message, Toast.LENGTH_SHORT).show();
        }

    }






}