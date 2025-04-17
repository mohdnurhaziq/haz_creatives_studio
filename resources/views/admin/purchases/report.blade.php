@extends('layouts.admin')

@section('title', 'Financial Report - Haz Creatives Studio')

@section('header', 'Financial Report')

@section('content')
<style>
    /* Chart styling for dark theme */
    .chart-container {
        position: relative;
        height: 400px;
        width: 100%;
        background-color: var(--card-bg);
        padding: 20px;
        border-radius: 5px;
    }
    
    /* Table styling for dark theme */
    .table.table-hover {
        color: #ffffff !important;
        margin-bottom: 0;
        background-color: #242424;
        border-collapse: collapse;
        width: 100%;
    }
    
    .table.table-hover thead {
        background-color: rgba(255, 255, 255, 0.1);
    }
    
    .table.table-hover thead th {
        color: #ffffff !important;
        border-bottom: 2px solid rgba(255, 255, 255, 0.2);
        padding: 15px;
        font-weight: 600;
        white-space: nowrap;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .table.table-hover tbody td {
        color: #ffffff !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding: 15px;
        vertical-align: middle;
        font-size: 14px;
    }
    
    .table.table-hover tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
    
    .table.table-hover .text-success {
        color: #2ecc71 !important;
        font-weight: 600;
    }
    
    .table.table-hover .text-danger {
        color: #ff6b6b !important;
        font-weight: 600;
    }

    .btn-outline-secondary {
        color: #ffffff;
        border-color: rgba(255, 255, 255, 0.2);
        padding: 8px 15px;
    }

    .btn-outline-secondary:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        border-color: rgba(255, 255, 255, 0.4);
    }

    .card {
        background-color: #242424;
        border: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 1.5rem;
    }

    .card-header {
        background-color: rgba(255, 255, 255, 0.05);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding: 1.25rem;
    }

    .card-header h5 {
        color: #ffffff;
        font-weight: 600;
        margin: 0;
    }

    .card-body {
        padding: 1.25rem;
    }

    .table-responsive {
        margin: 0;
        border-radius: 5px;
    }

    .btn-group {
        gap: 8px;
    }

    .btn-group .btn {
        border-radius: 4px !important;
    }

    .btn i {
        margin-right: 5px;
    }

    .dark-theme-table {
        background: #1a1a1a;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .dark-theme-table table {
        width: 100%;
        border-collapse: collapse;
        color: #fff;
    }

    .dark-theme-table th,
    .dark-theme-table td {
        padding: 16px;
        text-align: left;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .dark-theme-table th {
        background: rgba(255, 255, 255, 0.05);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 0.5px;
    }

    .dark-theme-table tr:hover {
        background: rgba(255, 255, 255, 0.05);
    }

    .dark-theme-table .month-cell {
        color: #fff;
        font-weight: 500;
    }

    .dark-theme-table .income-cell {
        color: #2ecc71;
        font-weight: 600;
    }

    .dark-theme-table .expense-cell {
        color: #ff6b6b;
        font-weight: 600;
    }

    .dark-theme-table .net-positive {
        color: #2ecc71;
        font-weight: 600;
    }

    .dark-theme-table .net-negative {
        color: #ff6b6b;
        font-weight: 600;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Financial Trends</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Monthly Summary</h5>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="downloadPDF()">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="downloadCSV()">
                            <i class="fas fa-file-csv"></i> Export CSV
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="dark-theme-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Total Income</th>
                                    <th>Total Expenses</th>
                                    <th>Net Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($monthlyStats as $stat)
                                <tr>
                                    <td class="month-cell">
                                        {{ \Carbon\Carbon::createFromDate($stat->year, $stat->month, 1)->format('F Y') }}
                                    </td>
                                    <td class="income-cell">
                                        RM {{ number_format($stat->total_income, 2) }}
                                    </td>
                                    <td class="expense-cell">
                                        RM {{ number_format($stat->total_expense, 2) }}
                                    </td>
                                    <td class="{{ $stat->net_amount >= 0 ? 'net-positive' : 'net-negative' }}">
                                        RM {{ number_format($stat->net_amount, 2) }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" style="text-align: center; color: #fff;">
                                        No data available
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('monthlyChart').getContext('2d');
    const monthlyData = @json($monthlyStats);
    
    if (!monthlyData || monthlyData.length === 0) {
        const noDataText = ctx.canvas.getContext('2d');
        noDataText.font = '16px Arial';
        noDataText.fillStyle = 'rgba(255, 255, 255, 0.7)';
        noDataText.textAlign = 'center';
        noDataText.fillText('No data available', ctx.canvas.width / 2, ctx.canvas.height / 2);
        return;
    }
    
    // Reverse the data to show oldest to newest
    const labels = monthlyData.map(stat => {
        const date = new Date(stat.year, stat.month - 1);
        return date.toLocaleDateString('en-US', { month: 'short', year: 'numeric' });
    }).reverse();

    const incomeData = monthlyData.map(stat => stat.total_income).reverse();
    const expenseData = monthlyData.map(stat => stat.total_expense).reverse();
    const netData = monthlyData.map(stat => stat.net_amount).reverse();

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Income',
                    data: incomeData,
                    borderColor: '#27a776',
                    backgroundColor: 'rgba(39, 167, 118, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2
                },
                {
                    label: 'Expenses',
                    data: expenseData,
                    borderColor: '#ff6b6b',
                    backgroundColor: 'rgba(255, 107, 107, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2
                },
                {
                    label: 'Net Amount',
                    data: netData,
                    borderColor: '#4dabf7',
                    backgroundColor: 'rgba(77, 171, 247, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    },
                    ticks: {
                        color: 'rgba(255, 255, 255, 0.7)',
                        callback: function(value) {
                            return 'RM ' + value.toLocaleString();
                        },
                        font: {
                            size: 12
                        }
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    },
                    ticks: {
                        color: 'rgba(255, 255, 255, 0.7)',
                        font: {
                            size: 12
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: 'rgba(255, 255, 255, 0.7)',
                        font: {
                            size: 13
                        },
                        padding: 20
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: 'rgba(255, 255, 255, 0.9)',
                    bodyColor: 'rgba(255, 255, 255, 0.9)',
                    padding: 12,
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': RM ' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            }
        }
    });
});

// Export functions
function downloadPDF() {
    // Add PDF export functionality
    alert('PDF export will be implemented soon');
}

function downloadCSV() {
    // Add CSV export functionality
    alert('CSV export will be implemented soon');
}
</script>
@endpush 