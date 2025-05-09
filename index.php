<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>مخزن منتجات العناية بالبشرة</title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container py-5">
    <h1 class="text-center mb-5">مخزن منتجات العناية بالبشرة</h1>
    
    <div class="card mb-5">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">إضافة/تعديل منتج</h5>
      </div>
      <div class="card-body">
        <form id="product-form">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="name" class="form-label">اسم المنتج</label>
              <input type="text" class="form-control" id="name" required>
            </div>
            <div class="col-md-3">
              <label for="price" class="form-label">السعر (ريال)</label>
              <input type="number" step="0.01" class="form-control" id="price" required>
            </div>
            <div class="col-md-3">
              <label for="quantity" class="form-label">الكمية</label>
              <input type="number" class="form-control" id="quantity" required>
            </div>
            <div class="col-md-4">
              <label for="category" class="form-label">الفئة</label>
              <select class="form-select" id="category">
                <option value="">اختر الفئة</option>
                <option value="مرطب">مرطب</option>
                <option value="غسول">غسول</option>
                <option value="واقي شمس">واقي شمس</option>
                <option value="مصل">مصل</option>
                <option value="تونر">تونر</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="expiry" class="form-label">تاريخ الانتهاء</label>
              <input type="date" class="form-control" id="expiry">
            </div>
            <div class="col-md-4 d-flex align-items-end">
              <button type="submit" class="btn btn-primary w-100">حفظ المنتج</button>
            </div>
          </div>
          <input type="hidden" id="edit-id">
        </form>
      </div>
    </div>

    <div class="card mb-3">
      <div class="card-header bg-secondary text-white">
        <h5 class="mb-0">بحث عن المنتجات</h5>
      </div>
      <div class="card-body">
        <div class="input-group">
          <input type="text" id="search" class="form-control" placeholder="ابحث باسم المنتج أو الفئة...">
          <button class="btn btn-outline-secondary" type="button" id="search-btn">بحث</button>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header bg-success text-white">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="mb-0">قائمة المنتجات</h5>
          <span id="total-value" class="badge bg-light text-dark fs-6">إجمالي القيمة: 0 ريال</span>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover" id="product-table">
            <thead>
              <tr>
                <th>الاسم</th>
                <th>السعر</th>
                <th>الكمية</th>
                <th>الفئة</th>
                <th>الانتهاء</th>
                <th>الإجراءات</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/script.js"></script>
</body>
</html>
