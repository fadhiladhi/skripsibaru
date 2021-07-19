package com.viss.pemesanan.Fragment;

import android.app.ProgressDialog;
import android.os.Bundle;

import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.GridLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.request.JsonObjectRequest;
import com.viss.pemesanan.Adapter.CupangAdapter;
import com.viss.pemesanan.Adapter.PengirimanAdapter;
import com.viss.pemesanan.Model.Cupang;
import com.viss.pemesanan.Model.PengirimanModel;
import com.viss.pemesanan.Model.UserModel;
import com.viss.pemesanan.MySingleton;
import com.viss.pemesanan.R;
import com.viss.pemesanan.SessionHandler;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;


public class DataPengirimanFragment extends Fragment {
    private ProgressDialog pDialog;
    RecyclerView lv;
    UserModel user;
    PengirimanAdapter pengirimanAdapter;
    ArrayList<PengirimanModel> pengirimanList;
    public static final String url = "http://347f969e2cb4.ngrok.io/db_pemesanan/get_daftar_pengiriman.php";
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View v = inflater.inflate(R.layout.fragment_data_pengiriman, container, false);
        lv = v.findViewById(R.id.rv_pengiriman);
        SessionHandler session = new SessionHandler(getActivity());
        user = session.getUserDetails();
        GridLayoutManager gridLayoutManager = new GridLayoutManager(getActivity(),1,GridLayoutManager.VERTICAL, false);
        lv.setLayoutManager(gridLayoutManager);
        pengirimanList = new ArrayList<>();
        pengirimanAdapter = new PengirimanAdapter(getActivity(), pengirimanList);
        lv.setAdapter(pengirimanAdapter);
        getPengiriman();
        return v;
    }
    private void displayLoader() {
        pDialog = new ProgressDialog(getActivity());
        pDialog.setMessage("Sedang diproses...");
        pDialog.setIndeterminate(false);
        pDialog.setCancelable(false);
        pDialog.show();
    }
    private void getPengiriman() {
        displayLoader();
        JsonObjectRequest jsArrayRequest = new JsonObjectRequest
                (Request.Method.POST, url, null, response -> {
                    pDialog.dismiss();
                    try {
                        if (response.getInt("status1") == 0) {
                            JSONArray jsonArray = response.getJSONArray("pengiriman");
                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject jsonObject = jsonArray.getJSONObject(i);
                                PengirimanModel pengiriman = new PengirimanModel();
                                if(user.getUsername().equals(jsonObject.getString("namapenerima"))){
                                    pengiriman.setId(jsonObject.getString("id"));
                                    pengiriman.setJasapengiriman(jsonObject.getString("jasapengiriman"));
                                    pengiriman.setNamaikan(jsonObject.getString("namaikan"));
                                    pengiriman.setStatus(jsonObject.getString("status"));
                                    pengiriman.setNoresi(jsonObject.getString("noresi"));
                                    pengiriman.setTglpemesanan(jsonObject.getString("tglpemesanan"));
                                    pengirimanList.add(pengiriman);
                                }


                            }
                            pengirimanAdapter.notifyDataSetChanged();


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