<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $logo
 * @property string $doc
 * @property string $demo
 * @property string $repo
 * @property string $author
 * @property integer $licenseID
 * @property integer $create_time
 * @property integer $update_time
 */
class Project extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Project the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'project';
	}
	
	public function beforeSave()
	{
		if ($this->isNewRecord)
			$this->submitBy = Yii::app()->user->id;
		return parent::beforeSave();
	}
	
	public function setDefaultLogo()
	{
		if($this->logo) return;
		$this->refresh();
		$tags = $this->getTagStrings();
		if(in_array('linux',$tags)){
			$this->logo = 'linux.png';
		}else{
			$this->logo = 'default.png';
		}
		$this->save();
	}
	
	public function getTagStrings()
	{
		$tags = array();
		foreach ($this->tags as $tag) {
			$tags[]=$tag->name;
		}
		return $tags;
	}
	
	public function attachTags($tags)
	{
		if(is_string($tags)){
			$tags = explode(',',$tags);
		}
		//compare new tags to the olds
		foreach($this->tags as $addedTag){
			$i = array_search($addedTag->name,$tags);
			if($i!==false){
				unset($tags[$i]);
			}else{
				$this->removeTag($addedTag);
			}
		}
		foreach ($tags as $tagName) {
			if(!$tagName) continue;
			$this->addTag($tagName);
		}
	}
	
	public function addTag($tagName)
	{
		$tagID = Tag::getTagID($tagName);
		$tagging = new ProjectTag;
		$tagging->tagID = $tagID;
		$tagging->projectID = $this->id;
		return $tagging->save();
	}
	
	public function removeTag($tag)
	{
		if(is_string($tag))
			$tagID = Tag::getTagID($tag);
		else
			$tagID = $tag->id;
		ProjectTag::model()->deleteAllByAttributes(array('tagID'=>$tagID,'projectID'=>$this->id));
	}
	
	public function behaviors(){
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'setUpdateOnCreate'=>true,
			)
		);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, url,description', 'required'),
			array('logo,doc,repo,licenseID,author,demo,description,intro','safe'),
			array('licenseID, create_time, update_time', 'numerical', 'integerOnly'=>true),
			array('name, logo, doc, demo, repo', 'length', 'max'=>128),
			array('url, author', 'length', 'max'=>64),
			array('url,doc,demo,repo','url'),
			array('url,name,repo','unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, url, logo, doc, demo, repo, author, licenseID, create_time, update_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'tags'=>array(self::MANY_MANY, 'Tag','project_tag(projectID,tagID)'),
			'submitUser'=>array(self::BELONGS_TO,'User','submitBy'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '名称',
			'url' => '项目地址',
			'intro'=>'一句话简介',
			'description'=>'介绍',
			'logo' => 'Logo',
			'doc' => '文档地址',
			'demo' => '示例',
			'repo' => 'Repo (github或者其他)',
			'author' => '作者',
			'licenseID' => '开源许可证',
			'create_time' => '收录时间',
			'update_time' => '更新时间',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('doc',$this->doc,true);
		$criteria->compare('demo',$this->demo,true);
		$criteria->compare('repo',$this->repo,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('licenseID',$this->licenseID);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('update_time',$this->update_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>array('id'=>CSort::SORT_DESC),
			),
		));
	}
}