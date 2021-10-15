

def heapify(i):
	l=2*i+1
	r=2*i+2
	if l<=n-1 and a[i]<a[l]:
		maxi=l
	else:
		maxi=i
	if r<=n-1 and a[maxi]<a[r]:     
		maxi=r
	if i!=maxi:
		temp=a[i]
		a[i]=a[maxi]
		a[maxi]=temp
		heapify(maxi)

n=int(input('length of array'))
a=list(map(int,input().split()))
for i in range(n//2,-1,-1):
	heapify(i)
print(a)