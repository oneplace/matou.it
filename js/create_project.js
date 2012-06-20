$(function(){
	$('#Project_repo').blur(function(){
		var repo = $(this).val();
		if(!repo) return;
		$.getJSON(baseUrl+'/auto/repo',{repo:repo},function(repo){
			if(!repo)return;
			$('#Project_name').val(repo.name);
			$('#Project_url').val(repo.homepage);
			$('#Project_author').val('<a href="https://github.com/'+repo.owner.login+'">'+repo.owner.login+'</a>');
			$('#Project_intro').val(repo.intro);
			$('#Project_description').val(repo.description).blur();
			$('input[name=project_tags]').removeTag(repo.language);
			$('input[name=project_tags]').addTag(repo.language);
			//console.log(data);
		});
	});
});