<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Kanit&display=swap');

            html, body {
                font-family: Kanit;
            }
            table {
                text-align: center;
            }
            .dropdown {
                text-align: center;
                margin: 15px 0px 15px 0px;
            }
            .pagination {
                width: 200px;
                margin: auto;
            }
            .pagination li {
                margin-left: 20px;
                margin-right: 20px;
            }
            nav a {
                text-decoration: none;
            }
            .form-group input {
                width: 100%;
            }
        </style>
    </head>
    <body>
        <nav style="margin-bottom: 20px;">
            <a href="/">หน้าหลัก</a>
            <a href="/risky-places">สถานที่เสี่ยง</a>
        </nav>
        <div class="user-information">
            <h4>ผู้ดูแลระบบ</h4>
        </div>
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                จัดการข้อมูล
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="/manager/reports">รายงานข้อมูลรายวัน</a></li>
                <li><a class="dropdown-item" href="/manager/places">รายงานสถานที่เสี่ยง</a></li>
            </ul>
        </div>
        <div class="modalButton" style="margin-bottom: 10px;">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRiskyPlaceModal">
                เพิ่มสถานที่เสี่ยง
            </button>
        </div>

        <div class="modal fade" id="addRiskyPlaceModal" tabindex="-1" aria-labelledby="addRiskyPlaceModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRiskyPlaceModalLabel">เพิ่มสถานที่เสี่ยง</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('add-risky-place') }}">
                            @csrf
                            <div class="form-group">
                                <div>
                                    <label>ชื่อสถานที่ :</label><br>
                                    <input type="text" name="name">
                                </div>
                                <div class="mt-3">
                                    <label>คำอธิบาย :</label><br>
                                    <textarea name="description" row="10" column="12" style="width: 100%; height: 70px; font-size: 10px;"></textarea>
                                </div>
                                <div class="mt-3">
                                    <label for="district_name">อำเภอ :</label><br>
                                    <input type="text" id="district_name" name="district_name">
                                </div>
                            </div>
                            <hr>
                            <div>
                                <button type="submit" style="margin-left: 80%;" class="btn btn-primary">เพิ่มข้อมูล</button>
                            </div>
                        </form>
                        <div class="modal-footer"></div>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped">
            <tr>
                <th>รหัส</th><th>ชื่อสถานที่</th><th>คำอธิบาย</th><th>อำเภอ</th><th>การเปลี่ยนแปลง</th>
            </tr>
            @foreach($places as $place)
                <tr>
                    <td>{{ $place->id }}</td>
                    <td>{{ $place->name }}</td>
                    <td>{{ $place->description }}</td>
                    <td>{{ $place->district_name }}</td>
                    <td><a href="{{ route('place-update-form', ['place_id' => $place->id]) }}" style="margin: 0px 30% 0px 10%;">แก้ไข</a><a href="{{ route('delete-place', ['place_id' => $place->id]) }}" style="margin-right: 10%">ลบ</a></td>
                </tr>
            @endforeach
        </table>
        <div>
            {{ $places->withQueryString()->links() }}
        </div>
    </body>
</html>