<script setup>
import Layout from './Layout/Layout.vue';
import { ref, defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  serviceRecords: Array,
  employees: Array,
  departments: Array,
});

const showForm = ref(false);
const currentServiceRecord = ref(null); // Track the current record being edited

const toggleForm = () => {
  showForm.value = !showForm.value;
};

const form = useForm({
  employee_id: null,
  department_id: null,
  start_date: null,
  role: null,
});

const submitForm = () => {
  if (currentServiceRecord.value) {
    form.put(route('service-records.update', currentServiceRecord.value.id), {
      onSuccess: () => {
        form.reset();
        showForm.value = false;
        currentServiceRecord.value = null;
      },
      onError: (errors) => {
        console.error('Form submission error', errors);
      },
    });
  } else {
    form.post(route('service-records.store'), {
      onSuccess: () => {
        form.reset();
        showForm.value = false;
      },
      onError: (errors) => {
        console.error('Form submission error', errors);
      },
    });
  }
};

const editRecord = (record) => {
  form.employee_id = record.employee_id;
  form.department_id = record.department_id;
  form.start_date = record.start_date;
  form.role = record.role;
  currentServiceRecord.value = record; // Track the record being edited
  showForm.value = true;
};

const deleteRecord = (id) => {
  if (confirm('Are you sure you want to delete this record?')) {
    form.delete(route('service-records.destroy', id), {
      onSuccess: () => {
        toast.success('Successfully Deleted!');
      },
      onError: (errors) => {
        toast.error("Delete error", errors);
      }
    });
  }
};
</script>


<template>
  <Layout>
    <Head title="Service Records" />
    <div class="bg-white p-6 shadow-md rounded-md border-b">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Service Records</h2>
        <button @click="toggleForm" class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700">
          {{ showForm ? 'Cancel' : 'Add Service Record' }}
        </button>
      </div>

      <div v-if="showForm" class="mb-6">
        <form @submit.prevent="submitForm" class="space-y-4">
          <div>
            <label for="employee_id" class="block text-sm font-medium text-gray-700">Employee</label>
            <select id="employee_id" v-model="form.employee_id" required
              class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
              <option value="">Select Employee</option>
              <option v-for="employee in employees" :key="employee.id" :value="employee.id">
                {{ employee.name }}
              </option>
            </select>
          </div>

          <div>
            <label for="department_id" class="block text-sm font-medium text-gray-700">Department</label>
            <select id="department_id" v-model="form.department_id" required
              class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
              <option value="">Select Department</option>
              <option v-for="department in departments" :key="department.id" :value="department.id">
                {{ department.name }}
              </option>
            </select>
          </div>

          <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
            <input id="start_date" v-model="form.start_date" type="date" required
              class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" />
          </div>

          <div>
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
            <input id="role" v-model="form.role" type="text" required
              class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
              placeholder="Role" />
          </div>

          <div class="flex justify-end">
            <button type="submit"
              class="px-6 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
              Save Service Record
            </button>
          </div>
        </form>
      </div>

      <table class="min-w-full bg-white border border-gray-200 shadow-sm rounded-lg">
        <thead class="bg-gray-50">
          <tr>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b">Employee</th>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b">Department</th>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b">Start Date</th>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b">Role</th>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="record in serviceRecords" :key="record.id" class="bg-white hover:bg-gray-50">
            <td class="py-3 px-4 border-b">{{ record.employee.name }}</td>
            <td class="py-3 px-4 border-b">{{ record.department.name }}</td>
            <td class="py-3 px-4 border-b">{{ record.start_date }}</td>
            <td class="py-3 px-4 border-b">{{ record.role }}</td>
            <td class="py-3 px-4 border-b flex space-x-2">
              <button @click="editRecord(record)"
                class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600">Edit</button>
              <button @click="deleteRecord(record.id)"
                class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </Layout>
</template>
