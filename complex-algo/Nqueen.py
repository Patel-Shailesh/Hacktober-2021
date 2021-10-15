
def Nqueen(rows,cols):
	for i in range(cols):
		if place(rows,i):
			sol[rows]=i
			if rows==n:
				return 
			else:
				Nqueen(rows+1,n)

def place(rows,cols):
	for j in range(rows-2):
		if (sol[j]==cols) or (abs(sol[j]-cols)==abs(j-rows)):
			return False
        return True


rows=int(input("enter square matrix dimension"))
# this is solution vector
sol=[0 for i in range(rows)]
print("solution is",Nqueen(rows,rows))
