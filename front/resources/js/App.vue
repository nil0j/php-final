<template>
    <nav class="m-4 p-4 w-1/4 flex justify-center content-center ml-auto mr-auto gap-4">
        <router-link class="router-link glow-hover" to="/"> Home </router-link>
        <router-link class="router-link glow-hover" to="/products"> Products </router-link>
        <a href="/login" class="router-link glow-hover"> Log in </a>
    </nav>

    <main class="glow p-10 px-14">
        <router-view v-slot="{ Component, route }">
            <div :key="route.name">
                <Component :is="Component" />
            </div>
        </router-view>
    </main>

</template>

<style scoped>
main {
    width: 60%;
    margin: 4em auto;
    align-items: center;
    border-color: var(--bg-secondary);
    border-width: 1px;
}

.router-link {
    font-weight: 500;
    padding: 5px 15px;
    color: var(--fg-secondary);
    border-color: var(--bg-secondary);
    border-width: 1px;
    border-style: solid;
}

.router-link:hover {
    border-color: var(--fg-secondary);
    background-color: rgba(var(--fg-secondary), 0.8);
}
</style>
