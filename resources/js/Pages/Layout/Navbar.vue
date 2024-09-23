<script setup>

</script>

<template>
  <div>
    <header class="bg-indigo-500 text-white">
      <nav class="flex items-center justify-between p-4 mx-auto">
        <div class="flex items-center space-x-4">
          <img src="/path-to-your-logo.png" alt="Logo" class="h-8 w-auto" />
        </div>

        <div class="space-x-6">
        </div>
      </nav>
    </header>

    <main class="bg-gray-100">
      <slot />
    </main>
  </div>
</template>

