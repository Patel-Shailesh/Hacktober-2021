
def heapify(i):
	while parent>=0:
		parent=(i-1)//2
		temp=a[i]
		a[i]=a[maxi]
		a[maxi]=temp
def insert(ele):
	a.append(ele)
	heapify(len(a)-1)

n=int(input('length of array'))
a=list(map(int,input().split()))
for i in range(n//2,-1,-1):
	heapify(i)
print(a)