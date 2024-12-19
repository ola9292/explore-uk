<script setup>
import { Link } from '@inertiajs/vue3'
</script>
<template>
    <nav>
        <div>
            <h3>
                <Link href="/">Explore Uk</Link>
            </h3>
        </div>

        <div class="header-nav_links">
            <Link href="/places/create">Create</Link>
            <Link href="/logout" method="post" as="button" type="button" class="btn btn-success">Logout</Link>
        </div>
    </nav>

</template>

<style scoped>
/* nav{
    display:flex;
    justify-items: space-between;
} */
</style>
