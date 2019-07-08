# 无参数
def hello():
    return 'Hi , Tommy'

# 传递参数
def hello_name(name):
    return 'Hi , ' + name

# 返回数组
def return_arr():
    user = {}
    user['name'] = 'Tommy'
    user['age']	 = 24
    return user

# 由于PHP传过来的参数都会被处理成字符串类型，所以需要使用数字类型的地方请自行转换，如若是其他类型数据做类似处理，否则会报错。
# 但是由Python传给PHP的结果的数据类型不受限制
def dosum(num1 , num2):
    return int(num1) + int(num2)
