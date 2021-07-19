package com.viss.pemesanan.Model;

public class UserModel {

    String id;
    String nama;
    String role;
    String username;

    public UserModel() {
    }

    public UserModel(String id, String nama, String role, String username) {
        this.id = id;
        this.nama = nama;
        this.role = role;
        this.username = username;
    }

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getNama() {
        return nama;
    }

    public void setNama(String nama) {
        this.nama = nama;
    }

    public String getRole() {
        return role;
    }

    public void setRole(String role) {
        this.role = role;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }
}
