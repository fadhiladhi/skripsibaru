package com.viss.pemesanan.Adapter;

import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.android.volley.ui.NetworkImageViewPlus;
import com.bumptech.glide.Glide;
import com.bumptech.glide.request.RequestOptions;
import com.viss.pemesanan.InputCupangActivity;
import com.viss.pemesanan.MainActivity;
import com.viss.pemesanan.Model.Cupang;
import com.viss.pemesanan.R;

import java.util.ArrayList;

public class CupangAdapter extends RecyclerView.Adapter<CupangAdapter.MyViewHolder> {

    Context context;
    ArrayList<Cupang> list;

    public CupangAdapter(Context context, ArrayList<Cupang> list) {
        this.context = context;
        this.list = list;
    }

    @NonNull
    @Override
    public MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {

        View v = LayoutInflater.from(context).inflate(R.layout.view_dataikan, parent, false);
        return new MyViewHolder(v);
    }

    @Override
    public void onBindViewHolder(@NonNull MyViewHolder holder, int position) {
        Cupang cupang = list.get(position);

        holder.nama.setText(cupang.getNama());
        holder.harga.setText(cupang.getHarga());
        String url = "http://347f969e2cb4.ngrok.io/pemesanan/uploads/"+cupang.getImg_url();
        Glide.with(context).load(url).apply(new RequestOptions().placeholder(R.drawable.ic_launcher_background).dontAnimate()).into(holder.img);
        holder.itemView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(context, InputCupangActivity.class);
                intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                intent.putExtra("id",list.get(position).getId() );
                context.startActivity(intent);
            }
        });
    }

    @Override
    public int getItemCount() {
        return list.size();
    }


    public class MyViewHolder extends RecyclerView.ViewHolder {
        NetworkImageViewPlus img ;
        TextView nama, harga;

        public MyViewHolder(@NonNull View itemView) {
            super(itemView);

            img = itemView.findViewById(R.id.img_cupang);
            nama = itemView.findViewById(R.id.nama_cupang);
            harga = itemView.findViewById(R.id.harga_cupang);
        }
    }
}
