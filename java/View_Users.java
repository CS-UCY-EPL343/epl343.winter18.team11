package c.tests.Team11;
/** This class gives the chance to the admin
 * to see all the users that have created
 * an account from the application. And see them
 * personal information
 */

import android.content.Context;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.widget.SwipeRefreshLayout;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ListView;
import android.widget.TextView;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.LinkedList;

public class View_Users extends Fragment {

    private ListView UserList; // The list that contains the company's employees
    private LinkedList<Listnode_View_Users> li = new LinkedList<Listnode_View_Users>();
    private Context context;
    private static Connection conn = null; // the connection to the database
    private String email, name, id, surname, state; // the main string for the list
    private SwipeRefreshLayout mSwipeRefreshLayout; // the ability to refresh
    private Custom_Adapter_View_Users mAdapter;
    private FragmentManager manager;
    private TextView search_textview;


    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        final View rootView = inflater.inflate(c.tests.Team11.R.layout.view_users,
                container, false);

        UserList = (ListView) rootView.findViewById(c.tests.Team11.R.id.EmployeeList);
        UserList.invalidateViews();
        context = container.getContext();

        return rootView;
    }

    @Override
    public void onViewCreated(View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);
        doInBackground();


        mAdapter = new Custom_Adapter_View_Users(context, c.tests.Team11.R.layout.layo_view_users, li);

        UserList.setAdapter(mAdapter);
        getActivity().setTitle("View Users");




    }



    /* This method creates for every entry that the query brings one list.  Then it uploads each
     * entry to the list that will be displayed on the screen. */
    protected void doInBackground() {

        ConnectDB connection = new ConnectDB();
        conn = connection.establishConnection(); // gets the connection to the database

        Account account = Account.getUniqueInstance(); // gets the account instance
        String getCountry = "Select * FROM  `User`";
        Statement stmt = null;


        if (conn == null)
            return;

        try {

            // Executes the query
            stmt = conn.createStatement();
            ResultSet rs = stmt.executeQuery(getCountry);



            // creates the list with the records that the query returned
            while (rs.next()) {
                name = rs.getString("Name");
                surname = rs.getString("Surname");
                email = rs.getString("Email");

                createlist();
            }

        } catch (SQLException e) {
            Log.e("Statare", e.getMessage());
        }

        // closes the connection to the database
        try {
            if (!conn.isClosed()) {
                Log.i("Statare", "Disconnecting from database...");
                conn.close();
                Log.i("Statare", "Done\n\nBye !");
            }
        } catch (Exception e) {
            Log.e("Statare", e.getMessage());
        }

    }

    /* This method creates the list with the proper elements that the list will have. */
    private void createlist() {
        Listnode_View_Users tmp = new Listnode_View_Users();

        tmp.Name = name;
        tmp.Surname = surname;
        tmp.Email = email;

        li.add(tmp);
    }

}
