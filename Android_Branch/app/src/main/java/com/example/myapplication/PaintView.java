package com.example.myapplication;

import android.app.ActionBar;
import android.content.Context;
import android.graphics.Canvas;
import android.graphics.Color;
import android.graphics.Paint;
import android.graphics.Path;
import android.view.MotionEvent;
import android.view.View;

/**
 * Class responsible for painting
 */
public class PaintView extends View {

   public ActionBar.LayoutParams params;
   private Path path= new Path();
   private Paint brush = new Paint();

    public PaintView(Context context) {
        super(context);

        brush.setAntiAlias(true);
        brush.setColor(Color.RED);
        brush.setStyle(Paint.Style.STROKE);
        brush.setStrokeJoin(Paint.Join.ROUND);
        brush.setStrokeWidth(0f);

        params= new ActionBar.LayoutParams(ActionBar.LayoutParams.MATCH_PARENT, ActionBar.LayoutParams.WRAP_CONTENT);


    }

    @Override
    public boolean onTouchEvent(MotionEvent event) {
        float pointx = event.getX();
        float pointy= event.getY();

        switch (event.getAction()){
            case MotionEvent.ACTION_DOWN:
                path.moveTo(pointx,pointy);
                return true;

            case MotionEvent.ACTION_MOVE:
                path.lineTo(pointx,pointy);
                break;
                default:
                    return false;

        }
        postInvalidate();
        return  false;

    }

    @Override
    protected void onDraw(Canvas canvas) {
canvas.drawPath(path, brush);
    }
}
