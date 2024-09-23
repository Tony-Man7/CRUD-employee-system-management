<script setup>
import Layout from './Layout/Layout.vue';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  departments: Array,
});

const showForm = ref(false);
const currentDepartment = ref(null); 

const toggleForm = () => {
  showForm.value = !showForm.value;
  form.reset();
};

const form = useForm({
  name: null,
  description: null,
});

const submitForm = () => {
  if (currentDepartment.value) {
    form.put(route('departments.update', currentDepartment.value.id), {
      onSuccess: () => {
        form.reset();
        showForm.value = false;
        currentDepartment.value = null;
      },
      onError: (errors) => {
        console.error("Form submission error", errors);
      }
    });
  } else {
    form.post(route('departments.store'), {
      onSuccess: () => {
        form.reset();
        showForm.value = false;
      },
      onError: (errors) => {
        console.error("Form submission error", errors);
      }
    });
  }
};

const editDepartment = (department) => {
  form.name = department.name;
  form.description = department.description;
  currentDepartment.value = department; 
  showForm.value = true;
};

const deleteDepartment = (id) => {
  if (confirm("Are you sure you want to delete this department?")) {
    form.delete(route('departments.destroy', id));
  }
};
</script>

<template>
  <Layout>
    <Head title="Departments" />
    <div class="bg-white p-6 shadow-md rounded-md border-b">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Departments</h2>
        <button @click="toggleForm" class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700">
          {{ showForm ? 'Cancel' : 'Add Department' }}
        </button>
      </div>

      <div v-if="showForm" class="mb-6">
        <form @submit.prevent="submitForm" class="space-y-4">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input id="name" v-model="form.name" type="text" required
              class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
              placeholder="Department Name" />
          </div>

          <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" v-model="form.description" 
              class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
              placeholder="Description"></textarea>
          </div>

          <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
              Create Department
            </button>
          </div>
        </form>
      </div>

      <table class="min-w-full bg-white border border-gray-200 shadow-sm rounded-lg">
        <thead class="bg-gray-50">
          <tr>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b">Name</th>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b">Description</th>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="department in departments" :key="department.id" class="bg-white hover:bg-gray-50">
            <td class="py-3 px-4 border-b">{{ department.name }}</td>
            <td class="py-3 px-4 border-b">{{ department.description }}</td>
            <td class="py-3 px-4 border-b flex space-x-2">
              <button @click="editDepartment(department)" class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600">Edit</button>
              <button @click="deleteDepartment(department.id)" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </Layout>
</template>
