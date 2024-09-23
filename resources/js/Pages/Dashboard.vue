<script setup>
import Layout from './Layout/Layout.vue';
</script>

<template>
  <Layout>
    <div>
      <h2 class="text-2xl font-bold mb-4">Dashboard Overview</h2>
      <p>Welcome, {{ $page.props.auth.user.name }}! Here's an overview of your dashboard.</p>
    </div>
  </Layout>
</template>
