@extends('dashboard.index')

@section('content')
<div class="container-fluid">
    <!-- Header Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="font-size: 2rem;">LazaPee</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Notifications Dropdown -->
                    <li class="nav-item dropdown me-3">
                        <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="badge bg-danger">3</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown">
                            <li><a class="dropdown-item" href="#">New message received</a></li>
                            <li><a class="dropdown-item" href="#">New user registered</a></li>
                            <li><a class="dropdown-item" href="#">Review added</a></li>
                        </ul>
                    </li>

                    <!-- Profile Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <!-- Check if profile image exists and load it -->
                            @if(Auth::user()->user_profile && file_exists(public_path('storage/' . Auth::user()->user_profile)))
                                <img src="{{ asset('storage/' . Auth::user()->user_profile) }}" alt="{{ Auth::user()->username }}'s Profile" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                            @else
                                <!-- Fallback if no image exists -->
                                <div class="rounded-circle bg-white border border-2" style="width: 30px; height: 30px;"></div>
                            @endif
                            {{ Auth::user()->username }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="{{ route('users.show', Auth::user()->id) }}">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Dashboard Metrics -->
    <div class="row text-center mb-4">
        <!-- Registered Users -->
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-sm bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Registered Users</h5>
                    <p class="card-text fs-4">{{ $registeredUsers }}</p>
                </div>
            </div>
        </div>

        <!-- Daily Visitors -->
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-sm bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Daily Visitors</h5>
                    <p class="card-text fs-4">{{ $dailyVisitors }}</p>
                </div>
            </div>
        </div>

        <!-- New Messages -->
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-sm bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">New Messages</h5>
                    <p class="card-text fs-4">{{ $newMessages }}</p>
                </div>
            </div>
        </div>

        <!-- Reviews -->
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card shadow-sm bg-danger text-white">
                <div class="card-body">
                    <h5 class="card-title">Reviews</h5>
                    <p class="card-text fs-4">{{ $reviews }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Purchase Behavior Chart -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">Purchase Behavior (Last 7 Days)</h5>
        </div>
        <div class="card-body">
            <canvas id="purchaseBehaviorChart"></canvas>
        </div>
    </div>

    <!-- Sales Performance Chart -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">Sales Performance (Last 7 Days)</h5>
        </div>
        <div class="card-body">
            <canvas id="salesPerformanceChart"></canvas>
        </div>
    </div>

</div>

<!-- Chart.js Script -->
<script>
    var ctx1 = document.getElementById('dailyVisitorsChart').getContext('2d');
    var dailyVisitorsChart = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'], // Days of the week
            datasets: [{
                label: 'Daily Visitors',
                data: @json($dailyVisitorsData), // Dynamic data passed from controller
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var ctx2 = document.getElementById('purchaseBehaviorChart').getContext('2d');
    var purchaseBehaviorChart = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'], // Days of the week
            datasets: [{
                label: 'Purchase Behavior',
                data: [10, 15, 8, 12, 20, 16, 25], // Sample data
                fill: false,
                borderColor: 'rgba(153, 102, 255, 1)',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var ctx3 = document.getElementById('salesPerformanceChart').getContext('2d');
    var salesPerformanceChart = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'], // Days of the week
            datasets: [{
                label: 'Sales Performance',
                data: [500, 600, 400, 800, 700, 650, 900], // Sample data for sales amount
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<!-- Bootstrap Bundle JS (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
@endsection