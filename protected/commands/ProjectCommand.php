<?php
class ProjectCommand extends CConsoleCommand
{
    public function actionTest()
		{
			$project = Project::model()->find();
			echo $project->name."\n";
		}
		
		public function actionCleartags()
		{
			$projectTags = ProjectTag::model()->findAll();
			foreach ($projectTags as $projectTag) {
				if($projectTag->project==null){
					$projectTag->delete();
					echo 'delete ';
				}
			}
		}
		
    public function actionInit() {}
}