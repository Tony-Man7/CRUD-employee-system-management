<script setup>

import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';


const notify = () => {
    toast("Deleted Successfully!", {
        autoClose: 1000,
    });
}
</script>

