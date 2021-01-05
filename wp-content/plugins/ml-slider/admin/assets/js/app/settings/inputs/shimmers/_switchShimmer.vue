<template>
	<div class="absolute flex flex-col bg-white inset-0 sm:p-6 px-4 py-5">
		<div class="gradient max-w-full rounded-lg h-7" :style="variableWidth()"></div>
		<div class="mt-2 sm:flex md:flex-grow sm:items-start sm:justify-between h-7">
			<div class="rounded-lg gradient max-w-xl h-full" :style="variableWidth()"></div>
			<div class="rounded-lg gradient mt-5 w-12 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex h-7 sm:items-center"></div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {}
	},
	created() {},
	mounted() {},
	methods: {
		variableWidth() {
			return 'width:' + (Math.floor(Math.random() * 75) + 30) + '%'
		}
	}
}
</script>
<style scoped>
.gradient {
    animation-duration: 1.8s;
    animation-fill-mode: forwards;
    animation-iteration-count: infinite;
    animation-name: placeHolderShimmer;
    animation-timing-function: linear;
    background: #f1f1f1;
    background: linear-gradient(to right, #f1f1f1 8%, #f8fafc 38%, #f1f1f1 54%);
    background-size: 1000px 640px;
    position: relative;
}
@keyframes placeHolderShimmer {
    0%{
        background-position: -468px 0
    }
    100%{
        background-position: 468px 0
    }
}
</style>