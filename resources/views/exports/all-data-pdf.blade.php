<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>All Data Export</title>
    <style>
        @page {
            margin: 15mm;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
            line-height: 1.3;
        }
        .page-break {
            page-break-after: always;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }
        .header p {
            margin: 3px 0;
            font-size: 10px;
        }
        .section-title {
            background-color: #f0f0f0;
            padding: 8px;
            margin: 15px 0 10px 0;
            font-weight: bold;
            font-size: 12px;
            border-left: 4px solid #4CAF50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
            padding: 6px;
            text-align: left;
            font-size: 9px;
        }
        td {
            padding: 5px;
            font-size: 8px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 8px;
            color: #666;
        }
        .text-center {
            text-align: center;
        }
        .badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
        }
        .badge-success { background-color: #d4edda; color: #155724; }
        .badge-warning { background-color: #fff3cd; color: #856404; }
        .badge-danger { background-color: #f8d7da; color: #721c24; }
        .badge-info { background-color: #d1ecf1; color: #0c5460; }
    </style>
</head>
<body>
    <!-- ITEMS PAGE -->
    <div class="header">
        <h1>InvenTrack</h1>
        <p>Complete Data Export Report</p>
        <p>Generated: {{ date('d F Y, H:i') }}</p>
    </div>

    <div class="section-title">ITEMS DATA ({{ $items->count() }} items)</div>
    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="20%">Item Name</th>
                <th width="12%">Serial Number</th>
                <th width="10%">Category</th>
                <th width="6%">Stock</th>
                <th width="15%">QR Code</th>
                <th width="9%">Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->serial_number ?? '-' }}</td>
                <td>{{ $item->kategori }}</td>
                <td class="text-center">{{ $item->stok }}</td>
                <td style="font-size: 7px;">{{ $item->qr_code }}</td>
                <td>{{ $item->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="page-break"></div>

    <!-- USERS PAGE -->
    <div class="header">
        <h1>InvenTrack</h1>
        <p>Complete Data Export Report</p>
        <p>Generated: {{ date('d F Y, H:i') }}</p>
    </div>

    <div class="section-title">USERS DATA ({{ $users->count() }} users)</div>
    <table>
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="22%">Name</th>
                <th width="25%">Email</th>
                <th width="10%">Role</th>
                <th width="17%">Department</th>
                <th width="12%">Phone</th>
                <th width="10%">Registered</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="badge {{ $user->role == 'admin' ? 'badge-danger' : 'badge-info' }}">
                        {{ strtoupper($user->role) }}
                    </span>
                </td>
                <td>{{ $user->department ?? '-' }}</td>
                <td>{{ $user->phone_number ?? '-' }}</td>
                <td>{{ $user->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="page-break"></div>

    <!-- MOVEMENTS PAGE -->
    <div class="header">
        <h1>InvenTrack</h1>
        <p>Complete Data Export Report</p>
        <p>Generated: {{ date('d F Y, H:i') }}</p>
    </div>

    <div class="section-title">MOVEMENTS HISTORY ({{ $movements->count() }} records)</div>
    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="8%">Date</th>
                <th width="18%">Item Name</th>
                <th width="6%">Type</th>
                <th width="5%">Qty</th>
                <th width="12%">Source</th>
                <th width="20%">Reason</th>
                <th width="18%">Notes</th>
                <th width="10%">User</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movements as $index => $movement)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $movement->date->format('d/m/Y') }}</td>
                <td>{{ $movement->barang->nama_barang }}</td>
                <td class="text-center">
                    <span class="badge {{ $movement->type == 'in' ? 'badge-success' : 'badge-warning' }}">
                        {{ strtoupper($movement->type) }}
                    </span>
                </td>
                <td class="text-center">{{ $movement->quantity }}</td>
                <td>{{ $movement->source ?? '-' }}</td>
                <td>{{ $movement->reason }}</td>
                <td>{{ $movement->notes ?? '-' }}</td>
                <td>{{ $movement->user->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="page-break"></div>

    <!-- BORROWINGS PAGE -->
    <div class="header">
        <h1>InvenTrack</h1>
        <p>Complete Data Export Report</p>
        <p>Generated: {{ date('d F Y, H:i') }}</p>
    </div>

    <div class="section-title">BORROWING HISTORY ({{ $borrowings->count() }} records)</div>
    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="13%">Borrower</th>
                <th width="12%">Department</th>
                <th width="18%">Item</th>
                <th width="8%">Borrow</th>
                <th width="8%">Due Date</th>
                <th width="20%">Reason</th>
                <th width="10%">Status</th>
                <th width="8%">Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach($borrowings as $index => $borrowing)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $borrowing->user->name }}</td>
                <td>{{ $borrowing->user->department ?? '-' }}</td>
                <td>{{ $borrowing->barang->nama_barang }}</td>
                <td>{{ $borrowing->created_at->format('d/m/Y') }}</td>
                <td>{{ $borrowing->return_due_date ? \Carbon\Carbon::parse($borrowing->return_due_date)->format('d/m/Y') : '-' }}</td>
                <td>{{ $borrowing->reason }}</td>
                <td class="text-center">
                    @php
                        $statusClass = 'badge-info';
                        if($borrowing->status == 'returned') $statusClass = 'badge-success';
                        elseif($borrowing->status == 'rejected') $statusClass = 'badge-danger';
                        elseif($borrowing->status == 'borrowed') $statusClass = 'badge-warning';
                    @endphp
                    <span class="badge {{ $statusClass }}">
                        {{ strtoupper($borrowing->status) }}
                    </span>
                </td>
                <td>{{ $borrowing->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>© {{ date('Y') }} InvenTrack - All Rights Reserved</p>
    </div>
</body>
</html>