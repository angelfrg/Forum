<h1 class="tt-title-border">
	Crear Post
</h1>
<form class="form-default form-create-topic">
	<div class="form-group">
		<label for="inputTopicTitle">Título del Post</label>
		<div class="tt-value-wrapper">
			<input type="text" name="name" class="form-control" id="inputTopicTitle" placeholder="Tema de tu post" maxlength="50" onkeydown="modificarValor(this.id, 'maxTema', event, 50)">
			<span id="maxTema" class="tt-value-input">50</span>
		</div>
		<div class="tt-note">Describe tu post de manera breve.</div>
	</div>
	<div class="form-group">
		<label>Tipo de Post</label>
		<div class="tt-js-active-btn tt-wrapper-btnicon">
			<div class="row tt-w410-col-02">
				<div class="col-4 col-lg-3 col-xl-2">
					<a href="#" class="tt-button-icon">
                                    <span class="tt-icon">
                                        <svg>
                                            <use xlink:href="#icon-discussion"></use>
                                        </svg>
                                    </span>
						<span class="tt-text">Debate</span>
					</a>
				</div>
				<div class="col-4 col-lg-3 col-xl-2">
					<a href="#" class="tt-button-icon">
                                    <span class="tt-icon">
                                         <svg>
                                            <use xlink:href="#Question"></use>
                                        </svg>
                                    </span>
						<span class="tt-text">Pregunta</span>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="pt-editor">
		<h6 class="pt-title">Cuerpo del Post</h6>
		<div class="form-group">
			<textarea name="message" class="form-control" id="textAreaPost" rows="5" maxlength="500" placeholder="Describe tu cuestión" maxlength="300" onkeydown="modificarValor(this.id, 'maxCuerpo', event, 500)"></textarea>
            <span id="maxCuerpo" class="tt-value-input">500</span>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="inputTopicTitle">Categoría</label>
					<select class="form-control">
						<option value="Select">Selecciona una ...</option>
						<option value="Value 01">Value 01</option>
						<option value="Value 02">Value 02</option>
					</select>
				</div>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<label for="inputTopicTags">Tags</label>
                    <div class="tt-value-wrapper">
                        <input type="text" name="name" class="form-control" id="inputTopicTags" maxlength="30" placeholder="Separa los tags con una coma" onkeydown="modificarValor(this.id, 'maxTags', event, 30)">
                        <span id="maxTags" class="tt-value-input">30</span>
                    </div>

				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-auto ml-md-auto">
				<a href="#" class="btn btn-secondary btn-width-lg">Crear Post</a>
			</div>
		</div>
	</div>
</form>