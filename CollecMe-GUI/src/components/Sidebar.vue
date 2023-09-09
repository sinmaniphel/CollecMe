<script setup lang="ts">
import HomeIcon from 'vue-material-design-icons/Home.vue';
import BookHeartIcon from 'vue-material-design-icons/BookHeart.vue';

</script>

<template>
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-dark align-middle" style="width: 280px; height: 100%;">
        <a href="/" class="navbar-brand nav-link link-light">CollecMe
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="#" class="nav-link active" aria-current="page">
                    <HomeIcon></HomeIcon>
                    Home
                </a>
            </li>
            <li>
                <a href="#" class="nav-link link-light">
                    <BookHeartIcon/>
                    My Collections
                </a>
            </li>
            <li>
                <a href="#" class="nav-link link-light">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#table"></use>
                    </svg>
                    Orders
                </a>
            </li>
            <li>
                <a href="#" class="nav-link link-light">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#grid"></use>
                    </svg>
                    Products
                </a>
            </li>
            <li>
                <a href="#" class="nav-link link-light">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#people-circle"></use>
                    </svg>
                    Customers
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center link-light text-decoration-none dropdown-toggle" id="dropdownUser2"
                data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong>mdo</strong>
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
    </div>
</div></template>