<?php
class UserController{
    public function store($request){
        $input = new UserStoreInput($request);
        $not = new EmailNotification();
        $useCase = new UserStoreAndEmailNotification($not);
        $jsonP = new JsonPresenter();
        return $useCase->storAndNotify($input,$jsonP);
    }
}
class UserStoreAndEmailNotification{
    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    public function storAndNotify($request,Presenter $p)
    {
        $user = (new User())->make($request);
        new UserModel($user)->save();

        return $p->parse($user);
    }
}
class UserModel{
    public function save($data){
//        $this->username = $data['username'];
//        $this->email = $data['email'];
//        $this->age = $data['age'];
//        $this->save();
        DB::persist($data);
    }
}
class User{
    public function make($data){
        $this->username = $data['username'];
        $this->email = $data['email'];
        $this->age = $this->getAge();
        return $this;
    }
    public function getAge(){
        if($age < 18) throw new Exception('You dont allow');
    }
}
interface InputBoundary{
    public function make($data);
}
class UserStoreInput implements InputBoundary{
    public function make($data)
    {
       return array_merge($data, bcrypt($data['password']));
    }
}
interface Presenter{
    public function parse($dataObj);
}
class JsonPresenter implements Presenter {
    public function parse($dataObject)
    {
        return json_encode([
            'id' => $dataObject->id,
            'username' => $dataObject->username
        ]);
    }
}
