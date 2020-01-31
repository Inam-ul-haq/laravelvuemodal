<template>
	<div id="home" class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card card-body">
					<div ref="content">
                        <h1> I am here</h1>
                   </div>
					<button class="btn btn-primary pl-5 pr-5" @click="download">Download PDF</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import jsPDF from 'jspdf'
import html2canvas from "html2canvas"
    export default {
	name: 'home',
	data() {
		return {
			name: ''
		}
	},
	methods: {
 download() {
  const doc = new jsPDF();
  const contentHtml = this.$refs.content.innerHTML;
  doc.fromHTML(contentHtml, 15, 15, {
    width: 170
  });
  doc.save("sample.pdf");
 },
downloadWithCSS() {
   const doc = new jsPDF();
   /** WITH CSS */
   var canvasElement = document.createElement('canvas');
    html2canvas(this.$refs.content, { canvas: canvasElement 
      }).then(function (canvas) {
    const img = canvas.toDataURL("image/jpeg", 0.8);
    doc.addImage(img,'JPEG',20,20);
    doc.save("sample.pdf");
   });
 },
 
}
}
</script>