@extends('header')
    <head>
        <title>หน้าหลัก</title>
        <style>
            ::-webkit-input-placeholder {
                font-size: 13px;
                text-align: left;
            }
            .history td {
                font-size: 12px;
            }
            .history table th {
                font-size: 13px;
            }
            .pagination {
                width: 200px;
                margin: auto;
            }
            .pagination li {
                margin-left: 20px;
                margin-right: 20px;
            }
            .risky-district table {
                font-size: 13px;
            }
            .risky-district .table {
                text-align: center;
            }
        </style>
    </head>
@section('content')
    <div style="width: 500px; height: 245px; margin: auto; margin-bottom: 30px; text-align: center;">
        <label style="margin-bottom: 15px;">สถานการณ์ COVID-19 ในจังหวัดเชียงใหม่ ประจำวันที่ {{ $format_day }}</label>
        <table style="display: inline; margin-right: 20px;">
            <tr>
                <td style="font-size: 10px; width: 100px; text-align: left;">
                    ผู้ป่วยรายใหม่ในวันนี้
                </td>
                <td style="background-color: red;">
                    @if(empty($report))
                        + 0
                    @else
                        + {{ $report->n_pmc + $report->n_ft + $report->n_prison }}
                    @endif
                </td>
            </tr>
           <tr>
                <td style="font-size: 10px; width: 150px; text-align: left;">
                    ค้นหาผู้ติดเชื้อเชิงรุกในชุมชน
                </td>
                <td style="text-align: right;">
                    @if (empty($report->n_pmc))
                        + 0
                    @else
                        {{ $report->n_pmc }}
                    @endif
                </td>
            </tr>
            <tr>
                <td style="font-size: 10px; width: 100px; text-align: left;">
                    จากเรือนจำ / ที่ต้องขัง
                </td>
                <td style="text-align: right;">
                    @if (empty($report->n_prison))
                        + 0
                    @else
                        {{ $report->n_prison }}
                    @endif
                </td>
            </tr>
            <tr>
                <td style="font-size: 10px; width: 150px; text-align: left;">
                    ผู้เดินทางจากต่างประเทศ
                </td>
                <td style="text-align: right;">
                    @if (empty($report->n_ft))
                        + 0
                    @else
                        {{ $report->n_ft }}
                    @endif
                </td>
            </tr>
            <td><br><br></td>
            <tr>
                <td style="font-size: 10px; width: 150px; text-align: left;">
                    ผู้ป่วยยืนยันสะสม
                </td>
                <td style="text-align: right; background-color: #f5a742;">
                    {{ $total_patients }}
                </td>
            </tr>
        </table>
        <table style="display: inline;">
            <tr>
                <td style="font-size: 10px; width: 100px; text-align: left;">
                    หายป่วยวันนี้
                </td>
                <td style="background-color: #60c22f;">
                    @if (empty($report->n_recovered))
                        + 0
                    @else
                        {{ $report->n_recovered }}
                    @endif
                </td>
            </tr>
            <tr>
                <td style="font-size: 10px; width: 150px; text-align: left;">
                    หายป่วยสะสม
                </td>
                <td style="text-align: right;">
                    {{ $total_recovered }}
                </td>
            </tr>
            <tr>
                <td style="font-size: 10px; width: 100px; text-align: left;">
                    ผู้ป่วยที่กำลังรักษาอยู่
                </td>
                <td style="text-align: right;">
                    {{ $total_patients - $total_recovered }}
                </td>
            </tr>
        </table>
        <table style="display: inline; position: relative; left:103px; bottom: 25px;">
            <tr>
                <td style="font-size: 10px; width: 150px; text-align: left;">
                    เสียชีวิตในวันนี้
                </td>
                <td style="color: white; background-color: #383837;">
                    @if (empty($report->n_death))
                        + 0
                    @else
                        {{ $report->n_death }}
                    @endif
                </td>
            </tr>
            <tr>
                <td style="font-size: 10px; width: 100px; text-align: left;">
                    เสียชีวิตสะสม
                </td>
                <td style="text-align: right;">
                    {{ $total_death }}
                </td>
            </tr>
        </table>
    </div>
    <div class="history" style="margin: auto; width: 500px; text-align: center;">
        <label style="margin-bottom: 10px;">ข้อมูลย้อนหลัง 15 วันล่าสุด</label>
        <table class="table" style="text-align: center; margin: auto;">
            <th>วันที่</th><th>ผู้ป่วยรายใหม่</th><th>รักษาหายแล้ว</th><th>เสียชีวิต</th>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->date }}</td>
                    <td>+ {{ $report->n_pmc + $report->n_prison + $report->n_ft }}</td>
                    <td>+ {{ $report->n_recovered }}</td>
                    <td>+ {{ $report->n_death }}</td>
                </tr>
            @endforeach
        </table><br>
        <div>
            {{ $reports->withQueryString()->links() }}
        </div>
    </div>
    <div class="risky-district" style="margin: auto; width: 500px; text-align: center;">
        <label style="margin-bottom: 10px;">พื้นที่เสี่ยงตามเขต</label>
        <table class="table" style="text-align: center; margin: auto;">
            <th>อำเภอ</th><th>จำนวนพื้นที่เสี่ยง</th>
            @foreach($rd_count as $rd)
            <tr>
                @if ($rd->places_count > 0)
                    <td>{{ $rd->name }}</td>
                    <td>{{ $rd->places_count }}</td>
                @else
                    <td>{{ $rd->name }}</td>
                    <td>ยังไม่มีข้อมูล / ไม่พบพื้นที่เสี่ยง</td>
                @endif
            </tr>
            @endforeach
        </table>
    </div>
    @error('auth-error')
        <script>
            Swal.fire({
                title: 'เกิดข้อผิดพลาด',
                text: 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง',
                icon: 'error',
                timer: 1700,
                timerProgressBar: true
            });
        </script>
        <div class="warn">{{ $message }}</div>
    @enderror
@endsection