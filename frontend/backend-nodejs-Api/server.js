const express = require("express");
const mysql = require("mysql2");
const cors = require("cors");

const app = express();
app.use(cors());
app.use(express.json());

const port = 8000;

// Kết nối MySQL
const db = mysql.createConnection({
  host: "127.0.0.1",
  user: "giang",       // user bạn đã tạo
  password: "123456",  // mật khẩu của user
  database: "ecommerce_db",
});

// Kiểm tra kết nối
db.connect((err) => {
  if (err) {
    console.error("DB connection failed:", err);
  } else {
    console.log("Connected to MySQL!");
  }
});

// API lấy tất cả sản phẩm
app.get("/api/product", (req, res) => {
  const sql = "SELECT * FROM product;"; // tên bảng là product
  db.query(sql, (err, result) => {
    if (err) {
      console.error("MySQL error:", err); // log lỗi chi tiết
      return res.status(500).json({ message: "Server error", error: err });
    }
    res.json(result);
  });
});

// Khởi chạy server
app.listen(port, () => {
  console.log(`Server is running on http://localhost:${port}`);
});
