<style>
    /* Custom styles for navbar text */
    .navbar-text {
        font-family: Arial, sans-serif;
        font-size: 25px;
        font-weight: bold;
        color: #6d7de5;
    }

    .navbar-text-second {
        font-family: Arial, sans-serif;
        font-size: 15px;
        font-weight: bold;
        color: #acacac;
    }

    /* Custom styles for logout button */
    .navbar-nav .nav-link {
        font-family: Arial, sans-serif;
        font-size: 16px;
    }

    /* Custom styles for navbar padding */
    .navbar {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }

    .badge {
        width: 18px;
        height: 18px;
        padding: 0;
        font-size: 12px;
        text-align: center;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-white">
    <div class="container-fluid">
        <!-- Place this tag where you want the button to render. -->

        <!-- Left side: Welcome message -->
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>
        <span class="navbar-text"><b>{{ Auth::user()->name }}</b></span>
        &nbsp;&nbsp;<small class="navbar-text-second">Administrator</small>

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item lh-1 me-3">
                <!-- Right side: Notifications and Logout button -->
                <ul class="navbar-nav ms-auto">
                    <!-- Notifications for admin -->
                    <li class="nav-item dropdown">
                        <a class="nav-link position-relative" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="menu-icon tf-icons bx bxs-bell fs-4"></i>
                            @php
                                $unreadCount = auth()->user()->unreadNotifications->count();
                            @endphp
                            @if ($unreadCount > 0)
                                <span
                                    class="badge bg-warning position-absolute top-0 start-100 translate-middle p-1 border border-light rounded-circle">
                                    {{ $unreadCount }}
                                </span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @forelse (auth()->user()->notifications as $notification)
                                <div class="d-flex justify-content-between align-items-center">
                                    <a class="dropdown-item" href="{{ route('laporan_cuti.index') }}">
                                        {{ $notification->data['message_2'] }}
                                        <br>
                                        <small
                                            class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    </a>
                                    <form action="{{ route('notifications.destroy', $notification->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus notifikasi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                            @empty
                                <div class="dropdown-item">Tidak ada notifikasi</div>
                            @endforelse
                        </div>
                    </li>
                </ul>
            </li>

            <!-- Logout button -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="btn rounded-pill btn-primary cols"><i class="bx bx-power-off me-2"></i>Log Out</span>
                </a>
            </li>
        </ul>

        <!-- Logout form -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</nav>

<script>
    document.getElementById('navbarDropdown').addEventListener('click', function() {
        let badge = this.querySelector('.badge');
        if (badge) {
            badge.style.display = 'none';
        }

        // Send request to mark all notifications as read
        fetch('{{ route('notifications.markAllAsRead') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        }).then(response => {
            if (!response.ok) {
                console.error('Failed to mark notifications as read.');
            }
        });
    });
</script>
