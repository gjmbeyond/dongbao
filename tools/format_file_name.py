#coding=utf-8
#导入功能包
import os
import json

#将需要格式化名称的文件所在的路径复制到这里
path = r'D:\dongbao\htmls\floor18'

#将路径中的分隔符全部换成正斜杠（windows的会改，linux的不会改，自动识别）
path = path.replace(os.path.sep, '/')

json_path = r'D:\dongbao\jsons'
json_path = json_path.replace(os.path.sep, '/')

print r'改路径下的文件将会被格式化：', path, r'，确认请按enter，取消请输入cancel后再按enter......'

#获取一个键盘输入，以enter键结束
command = raw_input()

#判断如果输入的命令是cancel就提前结束成
if command == 'cancel':
	os.sys.exit(1)

file_list = {}
file_list['files'] = []

#浏览path的路径，返回跑p（浏览的路径）、d（目录下文件夹列表）、f（文件列表）三个变量
for p, d, f in os.walk(path):
	#对每一个f中的元素，将该元素赋给file变量，并执行下面替换文件名的代码
	for file in f:
		#其中的Unicode编码表示‘【’
		format_filename = file.replace('\xa1\xbe', r'')
		#其中的Unicode编码表示‘】’
		format_filename = format_filename.replace('\xa1\xbf', r'_')
		#其中的Unicode编码表示‘十八楼C座’
		format_filename = format_filename.replace('\xca\xae\xb0\xcb\xc2\xa5C\xd7\xf9', r'floor18')
		format_filename = format_filename.replace(r'-', r'_')
		format_filename = format_filename.replace(r'~', r'_')
		format_filename = format_filename.replace(r'[', r'_')
		format_filename = format_filename.replace(r']', r'_')

		file_list['files'].append(format_filename)

		#调用os模块中的重命名函数的功能，对文件进行重命名，注意，需要组织完整的路径
		os.rename(p+'/'+file, p+'/'+format_filename)

json.dump(file_list, open(json_path+r'/floor18.json', 'w'), indent=4, ensure_ascii=False)

print r'格式化文件名完成'

os.sys.exit(0)