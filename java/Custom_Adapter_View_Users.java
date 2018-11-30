package c.tests.Team11;


import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import java.sql.Connection;
import java.util.List;

/** This a class that helps to create the view for the users list
 *
 */
public class Custom_Adapter_View_Users extends ArrayAdapter<Listnode_View_Users> {
    private Connection conn; // the connection to the database


    public Custom_Adapter_View_Users(Context context, int textViewResourceId, List<Listnode_View_Users> objects) {
        super(context, textViewResourceId, objects);
    }

    @Override
    public View getView(final int position, View convertView, ViewGroup parent) {

        ViewHolder viewHolder = null;

        // gets the text views from the screen
        if (convertView == null) {
            LayoutInflater inflater = (LayoutInflater)
                    getContext().getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            convertView = inflater.inflate(c.tests.Team11.R.layout.layo_view_users, null);
            viewHolder = new ViewHolder();
            viewHolder.Email = (TextView) convertView.findViewById(c.tests.Team11.R.id.test4);
            viewHolder.Name = (TextView) convertView.findViewById(c.tests.Team11.R.id.test2);
            viewHolder.Surname = (TextView) convertView.findViewById(c.tests.Team11.R.id.test3);

            convertView.setTag(viewHolder);
        } else {
            viewHolder = (ViewHolder) convertView.getTag();
        }

        // sets the right text to those text views
        final Listnode_View_Users l = (Listnode_View_Users) getItem(position);
        viewHolder.Name.setText(l.Name);
        viewHolder.Surname.setText(l.Surname);
        viewHolder.Email.setText(l.Email);


        return convertView;
    }


    /* This class sets that textviews and button for each element on the list */
    private class ViewHolder {
        TextView Name;
        TextView Surname;
        TextView Email;

    }
}