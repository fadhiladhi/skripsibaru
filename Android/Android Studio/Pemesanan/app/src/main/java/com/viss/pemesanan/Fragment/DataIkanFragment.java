package com.viss.pemesanan.Fragment;

import android.app.ProgressDialog;
import android.os.Bundle;

import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.GridLayoutManager;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.request.JsonObjectRequest;
import com.viss.pemesanan.Adapter.CupangAdapter;
import com.viss.pemesanan.Model.Cupang;
import com.viss.pemesanan.MySingleton;
import com.viss.pemesanan.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;


public class DataIkanFragment extends Fragment {
    private ProgressDialog pDialog;
    RecyclerView lv;
    CupangAdapter cupangAdapter;
    ArrayList<Cupang> cupangList;
    public static final String url = "http://347f969e2cb4.ngrok.io/db_pemesanan/get_daftar_cupang.php";

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View v =  inflater.inflate(R.layout.fragment_data_ikan, container, false);
        lv = v.findViewById(R.id.rv_cupang);
        GridLayoutManager gridLayoutManager = new GridLayoutManager(getActivity(),2,GridLayoutManager.VERTICAL, false);
        lv.setLayoutManager(gridLayoutManager);
        cupangList = new ArrayList<>();
        cupangAdapter = new CupangAdapter(getActivity(), cupangList);
        lv.setAdapter(cupangAdapter);
        getDataCupang();
        return v;
    }
    private void displayLoader() {
        pDialog = new ProgressDialog(getActivity());
        pDialog.setMessage("Sedang diproses...");
        pDialog.setIndeterminate(false);
        pDialog.setCancelable(false);
        pDialog.show();
    }
    private void getDataCupang() {
        displayLoader();
        JsonObjectRequest jsArrayRequest = new JsonObjectRequest
                (Request.Method.POST, url, null, response -> {
                    pDialog.dismiss();
                    try {
                        if (response.getInt("status") == 0) {
                            JSONArray jsonArray = response.getJSONArray("cupang");
                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject jsonObject = jsonArray.getJSONObject(i);
                                Cupang cupang = new Cupang();
                                cupang.setId(jsonObject.getString("id"));
                                cupang.setNama(jsonObject.getString("namaikan"));
                                cupang.setHarga(jsonObject.getString("harga"));
                                cupang.setImg_url(jsonObject.getString("img_url"));
                                cupang.setJenis(jsonObject.getString("jenisikan"));
                                cupang.setStock(jsonObject.getString("stock"));
                                cupang.setDeskripsi(jsonObject.getString("deskripsi"));
                                cupangList.add(cupang);

                            }
                            cupangAdapter.notifyDataSetChanged();


                        } else {
                            Toast.makeText(getActivity(),
                                    response.getString("message"), Toast.LENGTH_SHORT).show();
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }, error -> {
                    pDialog.dismiss();
                    Toast.makeText(getActivity(),
                            error.getMessage(), Toast.LENGTH_SHORT).show();
                });

        MySingleton.getInstance(getActivity()).addToRequestQueue(jsArrayRequest);
    }
}