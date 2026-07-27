<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} — Luminii CRM</title>
    <link rel="icon" href="/assets/images/favicon.ico">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/crm.css', 'resources/js/crm.js'])
    <link rel="stylesheet" href="{{ asset('css/crm-design-system.css') }}">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    {{ $head ?? '' }}
    @stack('head')
</head>
<body>

<div class="crm-shell" x-data="{ sidebar: false }">

    {{-- ── Sidebar overlay (mobile) ── --}}
    <div x-show="sidebar"
         x-transition:enter="transition duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebar = false"
         class="fixed inset-0 z-30 bg-[rgba(13,27,46,0.5)] lg:hidden"
         style="display:none;"></div>

    {{-- ── Sidebar ── --}}
    <aside class="crm-sidebar"
           :class="sidebar ? 'open' : ''"
           @click.outside="sidebar = false">

        {{-- Logo --}}
        <div class="crm-sidebar-header">
            <a href="{{ route('crm.dashboard') }}" class="flex items-center gap-0" style="text-decoration:none;line-height:1;user-select:none;">
                <span style="font-family:'Inter',sans-serif;font-size:1.0625rem;font-weight:400;color:rgba(255,255,255,0.50);letter-spacing:-0.025em;">use</span><span style="font-family:'Inter',sans-serif;font-size:1.0625rem;font-weight:700;color:#FFD60A;letter-spacing:-0.03em;">Luminii</span><span style="display:inline-flex;align-items:center;justify-content:center;width:19px;height:19px;background:rgba(255,255,255,0.10);border:1.5px solid rgba(255,255,255,0.18);border-radius:50%;margin-left:4px;flex-shrink:0;"><span style="font-family:'Inter',sans-serif;font-size:5.5px;font-weight:700;color:rgba(255,255,255,0.70);letter-spacing:-0.01em;line-height:1;">.com</span></span>
            </a>
        </div>

        {{-- Navigation --}}
        @php
            $reportsOpen = request()->routeIs('crm.reports');
            $systemOpen  = request()->routeIs('crm.notifications.*', 'crm.settings', 'crm.team.*', 'crm.users.*', 'crm.services.*');
        @endphp
        <nav class="crm-sidebar-nav">

            {{-- Dashboard (standalone) --}}
            <a href="{{ route('crm.dashboard') }}"
               class="crm-nav-item {{ request()->routeIs('crm.dashboard') ? 'active' : '' }}"
               style="margin-bottom:0.5rem;">
                <svg class="crm-nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            {{-- CRM Group --}}
            <div class="crm-nav-group" x-data="{ open: true }">
                <button type="button" class="crm-nav-group-hdr" @click="open = !open">
                    <svg class="crm-nav-group-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                    </svg>
                    <span class="crm-nav-group-lbl">CRM</span>
                    <svg class="crm-nav-group-chevron" :class="open ? '' : 'crm-chevron-closed'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5"/>
                    </svg>
                </button>
                <div class="crm-nav-tree"
                     x-show="open"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                    <a href="{{ route('crm.clients.index') }}" class="crm-nav-leaf {{ request()->routeIs('crm.clients.*') ? 'active' : '' }}">
                        <span class="crm-leaf-dot"></span>
                        Clients
                        @if($leadsCount > 0) <span class="crm-nav-badge">{{ $leadsCount }}</span> @endif
                    </a>
                    <a href="{{ route('crm.requests.index') }}" class="crm-nav-leaf {{ request()->routeIs('crm.requests.*') ? 'active' : '' }}">
                        <span class="crm-leaf-dot"></span>
                        Client Requests
                        @if($newRequestsCount > 0) <span class="crm-nav-badge">{{ $newRequestsCount }}</span> @endif
                    </a>
                    <a href="{{ route('crm.leads.index') }}" class="crm-nav-leaf {{ request()->routeIs('crm.leads.*') ? 'active' : '' }}">
                        <span class="crm-leaf-dot"></span>
                        Leads
                        @if($newLeadsCount > 0) <span class="crm-nav-badge">{{ $newLeadsCount }}</span> @endif
                    </a>
                    <a href="{{ route('crm.pipeline') }}" class="crm-nav-leaf {{ request()->routeIs('crm.pipeline') ? 'active' : '' }}">
                        <span class="crm-leaf-dot"></span>
                        Pipeline
                    </a>
                </div>
            </div>

            {{-- Operations Group --}}
            <div class="crm-nav-group" x-data="{ open: true }">
                <button type="button" class="crm-nav-group-hdr" @click="open = !open">
                    <svg class="crm-nav-group-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z"/>
                    </svg>
                    <span class="crm-nav-group-lbl">Operations</span>
                    <svg class="crm-nav-group-chevron" :class="open ? '' : 'crm-chevron-closed'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5"/>
                    </svg>
                </button>
                <div class="crm-nav-tree"
                     x-show="open"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                    <a href="{{ route('crm.quotes.index') }}" class="crm-nav-leaf {{ request()->routeIs('crm.quotes.*') ? 'active' : '' }}">
                        <span class="crm-leaf-dot"></span>
                        Quotes
                        @if($draftQuotesCount > 0) <span class="crm-nav-badge">{{ $draftQuotesCount }}</span> @endif
                    </a>
                    <a href="{{ route('crm.calendar') }}" class="crm-nav-leaf {{ request()->routeIs('crm.calendar') ? 'active' : '' }}">
                        <span class="crm-leaf-dot"></span>
                        Job Calendar
                    </a>
                    <a href="{{ route('crm.jobs.index') }}" class="crm-nav-leaf {{ request()->routeIs('crm.jobs.*') ? 'active' : '' }}">
                        <span class="crm-leaf-dot"></span>
                        Jobs
                        @if($activeJobsCount > 0) <span class="crm-nav-badge">{{ $activeJobsCount }}</span> @endif
                    </a>
                </div>
            </div>

            {{-- Finance Group --}}
            <div class="crm-nav-group" x-data="{ open: true }">
                <button type="button" class="crm-nav-group-hdr" @click="open = !open">
                    <svg class="crm-nav-group-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"/>
                    </svg>
                    <span class="crm-nav-group-lbl">Finance</span>
                    <svg class="crm-nav-group-chevron" :class="open ? '' : 'crm-chevron-closed'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5"/>
                    </svg>
                </button>
                <div class="crm-nav-tree"
                     x-show="open"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                    <a href="{{ route('crm.invoices.index') }}" class="crm-nav-leaf {{ request()->routeIs('crm.invoices.*') ? 'active' : '' }}">
                        <span class="crm-leaf-dot"></span>
                        Invoices
                        @if($overdueInvoicesCount > 0) <span class="crm-nav-badge">{{ $overdueInvoicesCount }}</span> @endif
                    </a>
                    <a href="{{ route('crm.recurring.index') }}" class="crm-nav-leaf {{ request()->routeIs('crm.recurring.*') ? 'active' : '' }}">
                        <span class="crm-leaf-dot"></span>
                        Recurring Invoices
                    </a>
                    <a href="{{ route('crm.expenses.index') }}" class="crm-nav-leaf {{ request()->routeIs('crm.expenses.*') ? 'active' : '' }}">
                        <span class="crm-leaf-dot"></span>
                        Expenses
                    </a>
                </div>
            </div>

            {{-- Reports Group --}}
            <div class="crm-nav-group" x-data="{ open: {{ $reportsOpen ? 'true' : 'false' }} }">
                <button type="button" class="crm-nav-group-hdr" @click="open = !open">
                    <svg class="crm-nav-group-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>
                    </svg>
                    <span class="crm-nav-group-lbl">Reports</span>
                    <svg class="crm-nav-group-chevron" :class="open ? '' : 'crm-chevron-closed'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5"/>
                    </svg>
                </button>
                <div class="crm-nav-tree"
                     x-show="open"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                    <a href="{{ route('crm.reports') }}" class="crm-nav-leaf {{ request()->routeIs('crm.reports') ? 'active' : '' }}">
                        <span class="crm-leaf-dot"></span>
                        Reports
                    </a>
                </div>
            </div>

            {{-- Settings Group --}}
            <div class="crm-nav-group" x-data="{ open: {{ $systemOpen ? 'true' : 'false' }} }">
                <button type="button" class="crm-nav-group-hdr" @click="open = !open">
                    <svg class="crm-nav-group-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="crm-nav-group-lbl">Settings</span>
                    <svg class="crm-nav-group-chevron" :class="open ? '' : 'crm-chevron-closed'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5"/>
                    </svg>
                </button>
                <div class="crm-nav-tree"
                     x-show="open"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0">
                    <a href="{{ route('crm.services.index') }}" class="crm-nav-leaf {{ request()->routeIs('crm.services.*') ? 'active' : '' }}">
                        <span class="crm-leaf-dot"></span>
                        Business Services
                    </a>
                    <a href="{{ route('crm.team.index') }}" class="crm-nav-leaf {{ request()->routeIs('crm.team.*') ? 'active' : '' }}">
                        <span class="crm-leaf-dot"></span>
                        Team
                    </a>
                    <a href="{{ route('crm.notifications.index') }}" class="crm-nav-leaf {{ request()->routeIs('crm.notifications.*') ? 'active' : '' }}">
                        <span class="crm-leaf-dot"></span>
                        Notifications
                        @if($unreadNotifications > 0) <span class="crm-nav-badge">{{ $unreadNotifications }}</span> @endif
                    </a>
                    <a href="{{ route('crm.settings') }}" class="crm-nav-leaf {{ request()->routeIs('crm.settings') ? 'active' : '' }}">
                        <span class="crm-leaf-dot"></span>
                        Settings
                    </a>
                </div>
            </div>

        </nav>

        {{-- User footer --}}
        <div class="crm-sidebar-footer">
            @auth
            <div class="crm-user-card" x-data="{ open: false }" @click="open = !open" style="position:relative;">
                <div class="crm-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                <div style="flex:1;min-width:0;">
                    <p style="font-size:0.8125rem;font-weight:600;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ auth()->user()->name }}</p>
                    <p style="font-size:0.6875rem;color:rgba(255,255,255,0.4);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ auth()->user()->email }}</p>
                </div>
                <svg style="width:1rem;height:1rem;color:rgba(255,255,255,0.3);flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/></svg>

                <div x-show="open" x-transition @click.stop
                     style="position:absolute;bottom:100%;left:0;right:0;margin-bottom:4px;background:#fff;border:1px solid #e4e9f0;border-radius:8px;box-shadow:0 8px 24px rgba(13,27,46,0.14);padding:0.375rem;z-index:50;"
                     x-cloak>
                    <a href="{{ route('crm.settings') }}" class="crm-dropdown-item">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Profile & Settings
                    </a>
                    <div class="crm-dropdown-sep"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="crm-dropdown-item crm-dropdown-item-danger" style="width:100%;">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Sign out
                        </button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </aside>

    {{-- ── Main content ── --}}
    <div class="crm-main">

        {{-- Topbar --}}
        <header class="crm-topbar">
            {{-- Mobile sidebar toggle --}}
            <button @click="sidebar = !sidebar"
                    class="crm-icon-btn lg:hidden">
                <svg style="width:1.25rem;height:1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>

            <span class="crm-topbar-title hidden lg:block">{{ $title }}</span>

            <div class="crm-topbar-actions">
                {{-- Notifications bell --}}
                <a href="{{ route('crm.notifications.index') }}" class="crm-icon-btn" style="position:relative;">
                    <svg style="width:1.125rem;height:1.125rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    @if($unreadNotifications > 0)
                        <span style="position:absolute;top:4px;right:4px;width:8px;height:8px;background:#f04438;border-radius:50%;border:1.5px solid #fff;"></span>
                    @endif
                </a>

                {{-- Quick link to Filament (during transition) --}}
                <a href="/useluminii" target="_blank" class="crm-btn crm-btn-secondary crm-btn-sm" title="Legacy CRM">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Legacy
                </a>
            </div>
        </header>

        {{-- Flash messages --}}
        @if(session('success'))
        <div style="background:#ecfdf3;border:1px solid #a7f3d0;color:#027a48;font-size:0.875rem;font-weight:500;padding:0.75rem 1.5rem;display:flex;align-items:center;gap:0.5rem;">
            <svg style="width:1rem;height:1rem;flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div style="background:#fef3f2;border:1px solid #fecdca;color:#b42318;font-size:0.875rem;font-weight:500;padding:0.75rem 1.5rem;display:flex;align-items:center;gap:0.5rem;">
            <svg style="width:1rem;height:1rem;flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
        @endif

        {{-- Page content --}}
        <main class="crm-content crm-fade-in">
            {{ $slot }}
        </main>
    </div>

</div>

@stack('scripts')
</body>
</html>
