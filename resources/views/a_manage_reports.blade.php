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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReportModal">
                เพิ่มข้อมูล
            </button>
        </div>
        <table class="table table-striped">
            <tr>
                <th>วันที่</th><th>พบจากการตรวจเชิงรุก</th><th>พบจากในที่คุมขัง</th><th>พบจากผู้เดินทางจากต่างประเทศ</th><th>รักษาหาย</th><th>เสียชีวิต</th><th>การเปลี่ยนแปลง</th>
            </tr>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->date }}</td>
                    <td>{{ $report->n_pmc }}</td>
                    <td>{{ $report->n_prison }}</td>
                    <td>{{ $report->n_ft }}</td>
                    <td>{{ $report->n_recovered }}</td>
                    <td>{{ $report->n_death }}</td>
                    <td><a href="{{ route('report-update-form', ['report_date' => $report->date]) }}" style="margin: 0px 30% 0px 10%;">แก้ไข</a><a href="{{ route('delete-report', ['report_date' => $report->date]) }}" style="margin-right: 10%">ลบ</a></td>
                </tr>
            @endforeach
        </table>
        <div>
            {{ $reports->withQueryString()->links() }}
        </div>

        <div class="modal fade" id="addReportModal" tabindex="-1" aria-labelledby="addReportModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addReportModalLabel">เพิ่มสถานที่เสี่ยง</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('add-report') }}">
                            @csrf
                            <?php $current_date = date('Y-m-d'); ?>
                            <div class="form-group">
                                <div>
                                    <label>วันที่ : <?php echo $current_date; ?></label><br>
                                    <input type="hidden" name="date" value="<?php echo $current_date; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                    <label>พบจากการตรวจเชิงรุก :</label>
                                    <input type="text" name="n_pmc">
                                </div>
                                <div class="form-group">
                                    <label>พบจากในที่คุมขัง :</label>
                                    <input type="text" name="n_prison">
                                </div>
                                <div class="form-group">
                                    <label>พบจากผู้เดินทางจากต่างประเทศ :</label>
                                    <input type="text" name="n_ft">
                                </div>
                                <div class="form-group">
                                    <label>รักษาหาย :</label>
                                    <input type="text" name="n_recovered">
                                </div>
                                <div class="form-group">
                                    <label>เสียชีวิต :</label>
                                    <input type="text" name="n_death">
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
    </body>
</html>