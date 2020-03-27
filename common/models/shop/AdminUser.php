<?php

namespace common\models\shop;

use Yii;

/**
 * This is the model class for table "wx_adminUser".
 *
 * @property int $au_id
 * @property string $au_name
 * @property string $au_db
 * @property string $nickName
 * @property int $sex 0:女1:男
 * @property string|null $hpic 头像路径
 * @property string $au_password
 * @property string $au_email
 * @property string $au_Tel
 * @property string|null $au_servicecode
 * @property string $au_QQ
 * @property string $au_mobile_phone
 * @property int $au_loginDate
 * @property int $au_last_login_time 上次登录时间
 * @property string $au_lastIp
 * @property int $isAdmin 1：超级管理员，2：超级操作员，3：4S店管理员，4：4S店操作员，5：厂家账号
 * @property string $areaids 厂家账号管理的id集合
 * @property int $isDel
 * @property int $a_areaId
 * @property int $isShow 0正常，1禁用
 * @property string $is_show_remark 禁用/启用原因
 * @property string $code 登录激活码
 * @property int $code_count 激活码可使用次数
 * @property int $type 0:管理员1:销售顾问（店销）2:销售顾问（数字营销）
 * @property int $role_id 角色ID
 * @property string $name 管理员称呼
 * @property int $advisor_id 关联销售顾问ID
 * @property int $bulletin_time 是否查看最新公告
 * @property int|null $addtime 添加时间
 * @property int $activating 0:未激活1:已激活
 * @property int $sort 排序
 * @property int $up
 * @property string $qrcode 二维码图片地址
 * @property int $status 1:为影子销售顾问
 * @property string|null $come_from 1:为4s店 2：为总控后台添加
 * @property int|null $from_xfl 0:车商通1:雪佛兰
 * @property int|null $pid 父级编号
 * @property int $has_subordinate 是否有下级
 * @property int|null $voice_status 智能通话-状态0未开启1启用2停用
 * @property int|null $voice_time 智能通话-分配号码时的时间
 * @property int $loss_set 流失客户接替账号设置 - 针对客服角色
 * @property int $first_by_loss_set 首保流失客户接替账号设置 - 针对客服角色
 * @property int|null $tgt_assign 是否可分配推广通（0-否，1-是）
 * @property int|null $clue_assign 是否可分配线索（0-否，1-是）
 * @property string|null $rank_photo 风采照
 */
class AdminUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wx_adminUser';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('wdb');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['au_name', 'au_last_login_time', 'areaids', 'a_areaId', 'code', 'name', 'status'], 'required'],
            [['sex', 'au_loginDate', 'au_last_login_time', 'isAdmin', 'isDel', 'a_areaId', 'isShow', 'code_count', 'type', 'role_id', 'advisor_id', 'bulletin_time', 'addtime', 'activating', 'sort', 'up', 'status', 'from_xfl', 'pid', 'has_subordinate', 'voice_status', 'voice_time', 'loss_set', 'first_by_loss_set', 'tgt_assign', 'clue_assign'], 'integer'],
            [['au_name', 'nickName', 'au_Tel'], 'string', 'max' => 30],
            [['au_db', 'name'], 'string', 'max' => 20],
            [['hpic', 'areaids', 'rank_photo'], 'string', 'max' => 100],
            [['au_password'], 'string', 'max' => 32],
            [['au_email'], 'string', 'max' => 60],
            [['au_servicecode', 'au_lastIp', 'come_from'], 'string', 'max' => 50],
            [['au_QQ', 'au_mobile_phone'], 'string', 'max' => 15],
            [['is_show_remark'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 16],
            [['qrcode'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'au_id' => 'Au ID',
            'au_name' => 'Au Name',
            'au_db' => 'Au Db',
            'nickName' => 'Nick Name',
            'sex' => '0:女1:男',
            'hpic' => '头像路径',
            'au_password' => 'Au Password',
            'au_email' => 'Au Email',
            'au_Tel' => 'Au Tel',
            'au_servicecode' => 'Au Servicecode',
            'au_QQ' => 'Au Qq',
            'au_mobile_phone' => 'Au Mobile Phone',
            'au_loginDate' => 'Au Login Date',
            'au_last_login_time' => '上次登录时间',
            'au_lastIp' => 'Au Last Ip',
            'isAdmin' => '1：超级管理员，2：超级操作员，3：4S店管理员，4：4S店操作员，5：厂家账号',
            'areaids' => '厂家账号管理的id集合',
            'isDel' => 'Is Del',
            'a_areaId' => 'A Area ID',
            'isShow' => '0正常，1禁用',
            'is_show_remark' => '禁用/启用原因',
            'code' => '登录激活码',
            'code_count' => '激活码可使用次数',
            'type' => '0:管理员1:销售顾问（店销）2:销售顾问（数字营销）',
            'role_id' => '角色ID',
            'name' => '管理员称呼',
            'advisor_id' => '关联销售顾问ID',
            'bulletin_time' => '是否查看最新公告',
            'addtime' => '添加时间',
            'activating' => '0:未激活1:已激活',
            'sort' => '排序',
            'up' => 'Up',
            'qrcode' => '二维码图片地址',
            'status' => '1:为影子销售顾问',
            'come_from' => '1:为4s店 2：为总控后台添加',
            'from_xfl' => '0:车商通1:雪佛兰',
            'pid' => '父级编号',
            'has_subordinate' => '是否有下级',
            'voice_status' => '智能通话-状态0未开启1启用2停用',
            'voice_time' => '智能通话-分配号码时的时间',
            'loss_set' => '流失客户接替账号设置 - 针对客服角色',
            'first_by_loss_set' => '首保流失客户接替账号设置 - 针对客服角色',
            'tgt_assign' => '是否可分配推广通（0-否，1-是）',
            'clue_assign' => '是否可分配线索（0-否，1-是）',
            'rank_photo' => '风采照',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\shop\query\AdminUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\shop\query\AdminUserQuery(get_called_class());
    }
}
