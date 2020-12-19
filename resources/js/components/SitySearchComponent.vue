<template>
    <div id="autocomplete">

        <input  name="clientCity" class="form-control search-suggest"  list="datalistOptions" id="clientCity"  required  type="text" placeholder="Город" v-model="query" >
        <datalist id="datalistOptions" v-if="results.length > 0 && query">
            <option v-for="result in results.slice(0,10)" :key="result.id" v-on:click="setCity(result.city)" :value="result.city"></option>
        </datalist>
    </div>

</template>

<script>
import debounce from 'debounce';

export default {
    data() {
        return {
            query: null,
            results: []
        };
    },
    watch: {
        query(after, before) {
            this.searchMembers();
        }
    },
    methods: {
        setCity(result) { //по суті і так працює
            console.log(result);
            this.query = result;
            this.isOpen = false;
        },
        searchMembers() {
            axios.get('/cart/city', { params: { search: this.query } })
                .then(response => this.results = response.data)
                .catch(error => {});
        }
    }
}
</script>
