package com.example.myapplication;

import org.junit.Test;

import java.util.ArrayList;

import static org.junit.Assert.assertEquals;

/**
 * Testing the basket activity
 */
public class BasketActivityTest {
    @Test
    public void testSummationofProducts() {
        BasketActivity ba = new BasketActivity();
        ArrayList<Float> sum = new ArrayList();
        float a = 10;
        float b = 15;
        sum.add(a);
        sum.add(b);
        float actual = ba.calculateSum(sum);
        // expected value is 212
        float expected = 25;
        // use this method because float is not precise
        assertEquals("Add the products for the customer total", expected, actual, 0.001);
    }

}