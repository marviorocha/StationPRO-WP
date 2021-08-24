<script context="module">
import {writable} from 'svelte/store'
const now = writable(Date.now())
export let timeZone = 'UTC'

setInterval(() => {
	now.set(Date.now())
}, 1000)
</script>

<span class=" leading-8 hidden md:block text-white"><i class="material-icons">schedule</i> 
    {new Date($now).toLocaleTimeString({timeZone})}
</span>