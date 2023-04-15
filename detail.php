<?php
$conn = mysqli_connect("localhost","root","","fashion_myshop");
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
  }

  if(isset($_POST['submit'])) {
    //Sử dụng mệnh đề LIKE ‘%$search_term%’ nó sẽ tìm bất kỳ giá trị nào bằng với $search_term
    $search_term = $_POST['search_term'];
    $sql = "SELECT * FROM products WHERE name LIKE '%$search_term%'";
    $result = mysqli_query($conn, $sql); //sử dụng hàm mysqli_query() để thực thi truy vấn SQL và lưu kết quả vào biến $result.
  }
?>

<!-- Hiển thị biểu mẫu tìm kiếm sản phẩm -->
<form action="page.php" method="post">
  <input type="text" name="search_term" placeholder="Tìm kiếm sản phẩm...">
  <button type="submit" name="submit">Tìm kiếm</button>
</form>

<!-- Hiển thị kết quả tìm kiếm -->
<?php if(isset($result)): ?>
  <?php if(mysqli_num_rows($result) > 0): ?>
    <ul>
      <?php while($row = mysqli_fetch_assoc($result)): ?>
        <li><?php echo $row['name']; ?></li>
      <?php endwhile; ?>
    </ul>
  <?php else: ?>
    <p>Không tìm thấy sản phẩm nào.</p>
  <?php endif; ?>
<?php endif; ?>

<?php mysqli_close($conn); ?>