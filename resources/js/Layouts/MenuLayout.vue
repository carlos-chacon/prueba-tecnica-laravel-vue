<script setup lang="ts">
import NavLink from "@/Components/NavLink.vue";
</script>

<template>
    <nav class="navbar navbar-expand-lg bg-dark py-3">
        <div class="container-fluid ">
            <a class="navbar-brand text-white" href="#">PHP - Vue</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <hr class="d-lg-none text-white-50" />
                <ul class="navbar-nav flex-row flex-wrap bd-navbar-nav pe-5">
                    <li class="nav-item">
                        <NavLink
                            class="nav-link text-white"
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            Dashboard
                        </NavLink>
                    </li>
                    <li class="nav-item">
                        <NavLink
                            class="nav-link text-white"
                            :href="route('student.index')"
                            :active="route().current('student.index')"
                        >
                            Estudiantes
                        </NavLink>
                    </li>
                </ul>
                <hr class="d-lg-none text-white-50" />
                <ul class="navbar-nav flex-row flex-wrap ms-md-auto">
                    <li class="nav-item dropdown ">
                        <a
                            class="nav-link dropdown-toggle text-white"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            {{ $page.props.auth.user.name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <NavLink
                                    class="dropdown-item"
                                    :href="route('profile.edit')"
                                    :active="route().current('profile.edit')"
                                >
                                    Edit
                                </NavLink>
                            </li>
                            <li>
                                <NavLink
                                    class="dropdown-item"
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                >
                                    Log Out
                                </NavLink>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
